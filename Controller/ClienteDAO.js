const db = require('../Conectiondb'); // ajuste o caminho conforme sua estrutura
const bcrypt = require('bcrypt');

class ClienteDAO {
  // Inserir cliente com hash de senha
  static async inserir(cliente) {
    try {
      const hash = await bcrypt.hash(cliente.senha, 10);

      const sql = `
        INSERT INTO cliente (nome, endereco, idade, cidade, telefone, cpf, senha)
        VALUES (?, ?, ?, ?, ?, ?, ?)
      `;
      const valores = [
        cliente.nome,
        cliente.endereco,
        cliente.idade,
        cliente.cidade,
        cliente.telefone,
        cliente.cpf,
        hash
      ];

      const [result] = await db.execute(sql, valores);
      return result;
    } catch (err) {
      throw err;
    }
  }

  // Listar todos os clientes (sem a senha)
  static async listar() {
    const sql = 'SELECT id, nome, endereco, idade, cidade, telefone, cpf FROM cliente';
    const [rows] = await db.execute(sql);
    return rows;
  }

  // Buscar cliente por ID
  static async buscarPorId(id) {
    const sql = 'SELECT id, nome, endereco, idade, cidade, telefone, cpf FROM cliente WHERE id = ?';
    const [rows] = await db.execute(sql, [id]);
    return rows[0];
  }

  // Atualizar cliente com verificação de CPF duplicado
  static async atualizar(cliente) {
    const sqlVerificaCpf = 'SELECT id FROM cliente WHERE cpf = ? AND id != ?';
    const [results] = await db.execute(sqlVerificaCpf, [cliente.cpf, cliente.id]);
    if (results.length > 0) {
      throw new Error('CPF já está em uso por outro cliente.');
    }

    if (!cliente.senha) {
      const sql = `
        UPDATE cliente
        SET nome = ?, endereco = ?, idade = ?, cidade = ?, telefone = ?, cpf = ?
        WHERE id = ?
      `;
      const valores = [
        cliente.nome,
        cliente.endereco,
        cliente.idade,
        cliente.cidade,
        cliente.telefone,
        cliente.cpf,
        cliente.id
      ];
      const [result] = await db.execute(sql, valores);
      return result;
    } else {
      const hash = await bcrypt.hash(cliente.senha, 10);
      const sql = `
        UPDATE cliente
        SET nome = ?, endereco = ?, idade = ?, cidade = ?, telefone = ?, cpf = ?, senha = ?
        WHERE id = ?
      `;
      const valores = [
        cliente.nome,
        cliente.endereco,
        cliente.idade,
        cliente.cidade,
        cliente.telefone,
        cliente.cpf,
        hash,
        cliente.id
      ];
      const [result] = await db.execute(sql, valores);
      return result;
    }
  }

  // Deletar cliente por ID
  static async deletar(id) {
    const sql = 'DELETE FROM cliente WHERE id = ?';
    const [result] = await db.execute(sql, [id]);
    return result;
  }

  // Autenticar cliente por CPF e senha
  static async autenticar(cpf, senha) {
    const sql = 'SELECT * FROM cliente WHERE cpf = ?';
    const [rows] = await db.execute(sql, [cpf]);

    if (rows.length === 0) {
      throw new Error('CPF não encontrado.');
    }

    const cliente = rows[0];
    const senhaValida = await bcrypt.compare(senha, cliente.senha);

    if (!senhaValida) {
      throw new Error('Senha incorreta.');
    }

    delete cliente.senha;
    return cliente;
  }
}

module.exports = ClienteDAO;
