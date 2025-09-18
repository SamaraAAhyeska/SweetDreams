// Cliente.js
const ClienteDAO = require('./Controller/ClienteDAO');

class Cliente {
  constructor(nome, endereco, idade, cidade, telefone, cpf, id = null) {
    this.id = id;
    this.nome = nome;
    this.endereco = endereco;
    this.idade = idade;
    this.cidade = cidade;
    this.telefone = telefone;
    this.cpf = cpf;
  }

  salvar(callback) {
    const dados = {
      nome: this.nome,
      endereco: this.endereco,
      idade: this.idade,
      cidade: this.cidade,
      telefone: this.telefone,
      cpf: this.cpf
    };

    ClienteDAO.inserir(dados, callback);
  }

  atualizar(callback) {
    if (!this.id) {
      return callback(new Error('ID do cliente não definido para atualização.'));
    }

    const dados = {
      id: this.id,
      nome: this.nome,
      endereco: this.endereco,
      idade: this.idade,
      cidade: this.cidade,
      telefone: this.telefone,
      cpf: this.cpf
    };

    ClienteDAO.atualizar(dados, callback);
  }

  deletar(callback) {
    if (!this.id) {
      return callback(new Error('ID do cliente não definido para exclusão.'));
    }

    ClienteDAO.deletar(this.id, callback);
  }

  static listarTodos(callback) {
    ClienteDAO.listar(callback);
  }

  static buscarPorId(id, callback) {
    ClienteDAO.buscarPorId(id, callback);
  }
}

module.exports = Cliente;
