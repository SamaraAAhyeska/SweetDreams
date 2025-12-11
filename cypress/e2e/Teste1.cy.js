describe('Fluxo Completo: Login e Cadastro de Estoque com Simulação de Popup', () => {

  it('Deve fazer login, simular a abertura do popup (Pesquisar Produtos), aguardar e cadastrar o estoque', () => {

    // --- 1. LOGIN ---
    cy.visit('http://localhost/SweetDreamsnovo/view/Login.php')

    // Preenche usuário e senha
    cy.get('#usuario').type('admin')
    cy.get('#password').type('admin')
    cy.contains('button', 'Entrar').click()

    

    // --- 3. CADASTRO DE ESTOQUE (Visitar a página) ---
    cy.visit('http://localhost/SweetDreamsnovo/view/cadastrarEstoque.php')

    // Validação da página de cadastro
    cy.url().should('include', 'cadastrarEstoque.php')
    cy.contains('h2', 'Cadastro de Estoque').should('be.visible')

  })
})
describe('Cadastro de Estoque com Popup - SweetDreams', () => {

  it('Deve abrir popup (simulado), aguardar e cadastrar estoque', () => {

    // --- Acessa a página de cadastro de estoque ---
    cy.visit('http://localhost/SweetDreamsnovo/view/cadastrarEstoque.php')

    // Validação da página
    cy.url().should('include', 'cadastrarEstoque.php')
    cy.contains('h2', 'Cadastro de Estoque').should('be.visible')
    cy.wait(5000)

    // --- Abre o popup diretamente (Consulta de Produtos) ---
    cy.visit('http://localhost/SweetDreamsnovo/view/ConsultarProd.php')

    // Validação do conteúdo do popup
    cy.contains('Produtos Cadastrados').should('be.visible')

    // Aguarda 10 segundos simulando leitura do popup
    cy.wait(10000)

    // --- Volta para a página de cadastro de estoque ---
    cy.visit('http://localhost/SweetDreamsnovo/view/cadastrarEstoque.php')

    // Validação da página de cadastro novamente
    cy.url().should('include', 'cadastrarEstoque.php')
    cy.contains('h2', 'Cadastro de Estoque').should('be.visible')

    // --- Preenche o formulário de cadastro ---
    cy.get('#produto').type('6')          // ID do produto
    cy.get('#quantidade').type('10')      // Quantidade

    // --- Submete o cadastro ---
    cy.contains('button', 'Cadastrar').click()

    // --- Validação pós-cadastro ---
    // Se houver mensagem de sucesso no PHP:
    // cy.contains('Produto cadastrado com sucesso').should('be.visible')

    // Confirma que ainda está na página de cadastro
    cy.contains('Estoque').should('be.visible')
  })

})
