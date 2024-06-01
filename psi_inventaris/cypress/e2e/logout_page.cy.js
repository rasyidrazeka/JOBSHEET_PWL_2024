describe('Pengujian Website PSI | Logout', () => {
  const loginUrl = 'http://127.0.0.1:8000/';
  const validUsername = 'admin';
  const validPassword = 'admin123';

  beforeEach(() => {
    cy.visit(loginUrl);
    cy.get('input[name="username"]').type(validUsername);
    cy.get('input[name="password"]').type(validPassword);
    cy.get('button[type="submit"]').click();
    cy.url().should('include', '/dashboard');
  });

  it('Cek sistem logout', () => {
    cy.get('.main-sidebar').should('be.visible');
    cy.get('#side-logout').submit();
    cy.url().should('include', loginUrl);
    cy.get('.swal2-popup').should('be.visible').within(() => {
      cy.get('.swal2-title').should('contain', 'Berhasil logout');
    });
  })
});