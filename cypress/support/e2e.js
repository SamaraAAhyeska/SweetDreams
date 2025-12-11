// ***********************************************************
// This example support/e2e.js is processed and
// loaded automatically before your test files.
//
// This is a great place to put global configuration and
// behavior that modifies Cypress.
//
// You can change the location of this file or turn off
// automatically serving support files with the
// 'supportFile' configuration option.
//
// You can read more here:
// https://on.cypress.io/configuration
// ***********************************************************

// Import commands.js using ES2015 syntax:
import './commands'
// Deixa toda digitação do Cypress mais lenta automaticamente
Cypress.Commands.overwrite('type', (originalFn, element, text, options) => {
  return originalFn(element, text, { ...options, delay: 130 }) 
})
// Arquivo: cypress/support/e2e.js (ou commands.js)

/**
 * Adiciona um novo comando: clica no elemento e espera um tempo definido.
 *
 * @param {string} name - Nome do comando (pode ser ignorado)
 * @param {JQuery<HTMLElement>} subject - O elemento DOM clicado.
 * @param {number} [delayMs=3000] - O tempo de espera em milissegundos (padrão é 3000ms).
 */
Cypress.Commands.add('clickAndWait', { prevSubject: true }, (subject, delayMs = 3000) => {
    // 1. Clica no elemento
    cy.wrap(subject).click();
    
    // 2. Adiciona a espera
    cy.wait(delayMs);
    
    // 3. Retorna o subject para permitir o encadeamento (chaining)
    return subject;
});