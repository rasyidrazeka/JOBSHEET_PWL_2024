describe('Pengujian Website PSI | Dashboard', () => {
    const loginUrl = 'http://127.0.0.1:8000/'; // Ganti dengan URL login yang sesuai
    const validUsername = 'admin';
    const validPassword = 'admin123';

    it('Cek sistem ketika aktor ingin menampilkan dashboard', () => {
        cy.visit(loginUrl);
        cy.get('input[name="username"]').type(validUsername);
        cy.get('input[name="password"]').type(validPassword);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/dashboard'); // Asumsikan setelah login berhasil diarahkan ke dashboard
    })
});