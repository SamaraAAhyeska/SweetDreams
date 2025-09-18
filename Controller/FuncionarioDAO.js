const db = require('../Controller/Conectiondb'); // ajuste conforme o caminho real
const bcrypt = require('bcrypt');

class FuncionarioDAO {
  // Inserir funcionário com hash da senha
  static async inserir(funcionario) {
    try {
      const hash = await bcrypt.hash(funcionario.senha, 10);

      const sql = `
        INSERT INTO funcionario (nome, endereco, idade, cidade, telefone, cpf, senha)
        VALUES (?, ?, ?, ?, ?, ?, ?)
      `;
      const valores = [
        funcionario.nome,
        funcionario.endereco,
        funcionario.idade,
        funcionario.cidade,
        funcionario.telefone,
        funcionario.cpf,
        hash
      ];

      const [result] = await db.execute(sql, valores);
      return result;
    } catch (err) {
      throw err;
    }
  }

  // Listar todos funcionários (sem a senha)
  static async listar() {
    const sql = 'SELECT idFun, nome, endereco, idade, cidade, telefone, cpf FROM funcionario';
    const [rows] = await db.execute(sql);
    return rows;
  }

  // Buscar funcionário por idFun
  static async buscarPorId(idFun) {
    const sql = 'SELECT idFun, nome, endereco, idade, cidade, telefone, cpf FROM funcionario WHERE idFun = ?';
    const [rows] = await db.execute(sql, [idFun]);
    return rows[0];
  }

  // Atualizar funcionário, com verificação de cpf duplicado e hash na senha (se fornecida)
  static async atualizar(funcionario) {
    // Verificar CPF duplicado
    const sqlVerificaCpf = 'SELECT idFun FROM funcionario WHERE cpf = ? AND idFun != ?';
    const [results] = await db.execute(sqlVerificaCpf, [funcionario.cpf, funcionario.idFun]);
    if (results.length > 0) {
      throw new Error('CPF já está em uso por outro funcionário.');
    }

    if (!funcionario.senha) {
      // Atualiza sem alterar senha
      const sql = `
        UPDATE funcionario SET nome = ?, endereco = ?, idade = ?, cidade = ?, telefone = ?, cpf = ?
        WHERE idFun = ?
      `;
      const valores = [
        funcionario.nome,
        funcionario.endereco,
        funcionario.idade,
        funcionario.cidade,
        funcionario.telefone,
        funcionario.cpf,
        funcionario.idFun
      ];
      const [result] = await db.execute(sql, valores);
      return result;
    } else {
      // Atualiza com senha nova (hash)
      const hash = await bcrypt.hash(funcionario.senha, 10);
      const sql = `
        UPDATE funcionario SET nome = ?, endereco = ?, idade = ?, cidade = ?, telefone = ?, cpf = ?, senha = ?
        WHERE idFun = ?
      `;
      const valores = [
        funcionario.nome,
        funcionario.endereco,
        funcionario.idade,
        funcionario.cidade,
        funcionario.telefone,
        funcionario.cpf,
        hash,
        funcionario.idFun
      ];
      const [result] = await db.execute(sql, valores);
      return result;
    }
  }

  // Deletar funcionário pelo idFun
  static async deletar(idFun) {
    const sql = 'DELETE FROM funcionario WHERE idFun = ?';
    const [result] = await db.execute(sql, [idFun]);
    return result;
  }

  // Autenticar funcionário (compara senha hash)
  static async autenticar(cpf, senha) {
    const sql = 'SELECT * FROM funcionario WHERE cpf = ?';
    const [rows] = await db.execute(sql, [cpf]);

    if (rows.length === 0) {
      throw new Error('CPF não encontrado.');
    }

    const funcionario = rows[0];
    const senhaValida = await bcrypt.compare(senha, funcionario.senha);
    if (!senhaValida) {
      throw new Error('Senha incorreta.');
    }

    // Remove a senha para segurança
    delete funcionario.senha;
    return funcionario;
  }
}

module.exports = FuncionarioDAO;
