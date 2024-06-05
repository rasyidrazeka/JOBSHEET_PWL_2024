describe('Pengujian Website PSI | Pelaporan Bulanan', () => {
    const loginUrl = 'http://127.0.0.1:8000/';
    const validUsername = 'admin';
    const validPassword = 'admin123';

    beforeEach(() => {
        cy.visit(loginUrl);
        cy.get('input[name="username"]').type(validUsername);
        cy.get('input[name="password"]').type(validPassword);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/dashboard');

        cy.get('.main-sidebar').should('be.visible');
        cy.get('#side-pelaporan').click();
        cy.url().should('include', '/pelaporan');
        cy.get('h1').should('contain', 'Daftar Pelaporan Bulanan');
    });

    it('Cek sistem ketika aktor ingin menampilkan pelaporan', () => {
        cy.get('#bulan').should('be.visible');
        cy.get('#bulan').select('May');
        cy.get('#tahun').should('be.visible');
        cy.get('#tahun').select('2023');
        cy.get('#tampilkan').click();
        cy.wait(2000);
        cy.get('#table_pelaporan tbody tr').should('have.length', 17);
    })
});