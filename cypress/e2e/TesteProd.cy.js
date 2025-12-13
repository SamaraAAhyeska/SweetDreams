describe('Fluxo Completo: Login e Cadastro de Estoque com Simulação de Popup', () => {

  it('Deve fazer login, simular a abertura do popup (Pesquisar Produtos), aguardar e cadastrar o estoque', () => {

    // --- 1. LOGIN ---
    cy.visit('http://localhost/SweetDreamsnovo/view/Login.php')

    // Preenche usuário e senha
    cy.get('#usuario').type('admin')
    cy.get('#password').type('admin')
    cy.contains('button', 'Entrar').click()
    cy.wait(4000)

     cy.contains('h2', 'Gerenciar Cadastros').should('be.visible')
     cy.contains("a", "Produtos").click()
         cy.wait(7000)

   cy.contains('a', 'Cadastrar novo Produto').click()
cy.contains('h2', 'Cadastro de Produtos').should('be.visible')

    cy.get('#nome').type('Brigadeiro de limão')
    cy.get('#descricao').type('kit com 10 unidades')
    cy.get('#preco').type('23.85')

    cy.contains('button', 'Cadastrar').click()
    cy.wait(2000)

    // --- ALTERAR COR + ESCOLHER UM EDITAR ALEATÓRIO ---
    cy.contains('a', 'Editar').then($links => {

      const total = $links.length
      expect(total).to.be.greaterThan(0)

      const indiceAleatorio = Math.floor(Math.random() * total)
      cy.log("Índice escolhido: " + indiceAleatorio)

      const link = cy.wrap($links.eq(indiceAleatorio))

      link
        .should('be.visible')
        .then($el => { 
          $el[0].style.color = 'blue'
          return cy.wrap($el)
        })
        .should('have.css', 'color', 'rgb(0, 0, 255)')

      cy.wait(3000)

      link.click()
    })

    // --- EDITAR ---
    cy.get('#descricao').type(' kit com 10 unidades')
    cy.get('#preco').clear().type('23.85')

    cy.contains('button', 'Salvar')
      .should('be.visible')
      .then($btn => {
        $btn[0].style.color = 'blue'
        return cy.wrap($btn)
      })
      .should('have.css', 'color', 'rgb(0, 0, 255)')

    cy.wait(2000)
    cy.contains('button', 'Salvar').click()
    cy.wait(2000)

    // --- EXCLUIR ALEATÓRIO ---
    cy.contains('a', 'Excluir').then($links => {

      const total = $links.length
      expect(total).to.be.greaterThan(0)

      const indiceAleatorio = Math.floor(Math.random() * total)
      cy.log("Índice escolhido: " + indiceAleatorio)

      const link = cy.wrap($links.eq(indiceAleatorio))

      link
        .should('be.visible')
        .then($el => { 
          cy.wait(2000)
          $el[0].style.color = 'blue'
          return cy.wrap($el)
        })
        .should('have.css', 'color', 'rgb(0, 0, 255)')
        .click()

      cy.wait(10000)

      cy.contains('button', 'Excluir')
        .should('be.visible')
        .then($btn => {
          $btn[0].style.color = 'blue'
          return cy.wrap($btn)
        })
        .should('have.css', 'color', 'rgb(0, 0, 255)')

      cy.wait(2000)
      cy.contains('button', 'Sim').click()
    })



   

  })
})

