const ClienteDAO = require('./dao/ClienteDAO'); // ajuste o caminho conforme seu projeto

async function testarInsercao() {
  try {
    const novoCliente = {
      nome: 'Maria Oliveira',
      endereco: 'Rua das Flores, 123',
      idade: 30,
      cidade: 'São Paulo',
      telefone: '11999999999',
      cpf: '12345678900',
      senha: 'senhaSegura123'
    };

    const resultado = await ClienteDAO.inserir(novoCliente);
    console.log('Cliente inserido com sucesso:', resultado);
  } catch (error) {
    console.error('Erro ao inserir cliente:', error.message);
  }
}

testarInsercao();
