const express = require('express');
const path = require('path');
const app = express();
const port = 3000;

// Permitir receber dados via form e JSON
app.use(express.urlencoded({ extended: true }));
app.use(express.json());

// Importar DAOs e conexão com banco de dados
const ClienteDAO = require('./Controller/ClienteDAO');
const ProdutoDAO = require('./Controller/ProdutoDAO');
const PedidoDAO = require('./Controller/PedidoDAO');
const EstoqueDAO = require('./Controller/EstoqueDAO');
const FuncionarioDAO = require('./Controller/FuncionarioDAO');
const db = require('./Controller/Conectiondb'); // Verifique se o nome do arquivo está correto

// Rota inicial: Página principal
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'view', 'PaginaInicial.html'));
});

// Rota: Página de login
app.get('/login', (req, res) => {
  res.sendFile(path.join(__dirname, 'view', 'login.html'));
});

// Rota: Página de cardápio
app.get('/cardapio', (req, res) => {
  res.sendFile(path.join(__dirname, 'view', 'cardapio.html'));
});

// Rota: Página de cadastro de cliente
app.get('/cadastro', (req, res) => {
  res.sendFile(path.join(__dirname, 'view', 'cadastrocliente.html'));
});

// Rota POST: processar login (modificada para aceitar 3 tipos de usuários)
app.post('/login', async (req, res) => {
  const { cpf, senha } = req.body;

  try {
    // Tenta login como cliente
    const [clientes] = await db.execute(
      'SELECT * FROM cliente WHERE cpf = ? AND senha = ?',
      [cpf, senha]
    );

    if (clientes.length > 0) {
      return res.redirect('/cardapio'); // cliente vai para o cardápio
    }

    // Tenta login como funcionário
    const [funcionarios] = await db.execute(
      'SELECT * FROM funcionario WHERE cpf = ? AND senha = ?',
      [cpf, senha]
    );

    if (funcionarios.length > 0) {
      return res.send(`
        <h2>Login realizado com sucesso (Funcionário)</h2>
        <a href="/">Voltar para o início</a>
      `);
    }

    // Tenta login como confeiteira (admin)
    const [confeiteiras] = await db.execute(
      'SELECT * FROM confeiteira WHERE cpf = ? AND senha = ?',
      [cpf, senha]
    );

    if (confeiteiras.length > 0) {
      return res.send(`
        <h2>Bem-vinda, Confeiteira (Admin)!</h2>
        <a href="/">Voltar para o início</a>
      `);
    }

    // Se nenhum deu certo
    res.status(401).send(`
      <h2>Login inválido</h2>
      <p>CPF ou senha incorretos.</p>
      <a href="/login">Tentar novamente</a>
    `);
  } catch (error) {
    console.error('Erro na rota de login:', error);
    res.status(500).send('Erro interno no servidor');
  }
});

// Rota POST: cadastrar cliente
app.post('/cadastro', async (req, res) => {
  const { nome, cpf, endereco, idade, cidade, senha } = req.body;

  try {
    await db.execute(
      'INSERT INTO cliente (nome, cpf, endereco, idade, cidade, senha) VALUES (?, ?, ?, ?, ?, ?)',
      [nome, cpf, endereco, idade, cidade, senha]
    );
    res.send('<h2>Cadastro realizado com sucesso!</h2><a href="/login">Ir para login</a>');
  } catch (error) {
    console.error('Erro ao cadastrar cliente:', error);
    res.status(500).send('Erro ao cadastrar');
  }
});

// Iniciar servidor
app.listen(port, () => {
  console.log(`✅ Servidor rodando em: http://localhost:${port}`);
});
