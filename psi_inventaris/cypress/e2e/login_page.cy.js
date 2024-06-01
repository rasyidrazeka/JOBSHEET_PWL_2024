describe('Pengujian Website PSI | Login', () => {
    const loginUrl = 'http://127.0.0.1:8000/'; // Ganti dengan URL login yang sesuai
    const validUsername = 'admin';
    const validPassword = 'admin123';
    const invalidUsername = 'gailgascream';
    const invalidPassword = 'dangdutrock';

    beforeEach(() => {
        cy.visit(loginUrl);
    });

    it('Cek sistem untuk menampilkan halaman login', () => {
        cy.get('input[name="username"]').should('be.visible');
        cy.get('input[name="password"]').should('be.visible');
        cy.get('button[type="submit"]').should('be.visible');
    });

    it('Periksa perilaku sistem ketika email dan kata sandi yang valid dimasukkan', () => {
        cy.get('input[name="username"]').type(validUsername);
        cy.get('input[name="password"]').type(validPassword);
        cy.get('button[type="submit"]').click();

        // Asumsikan setelah login berhasil, pengguna akan diarahkan ke dashboard dengan URL /dashboard
        cy.url().should('include', '/dashboard');
    });

    it('Periksa perilaku sistem ketika email yang tidak valid dan kata sandi yang valid dimasukkan', () => {
        cy.get('input[name="username"]').type(invalidUsername);
        cy.get('input[name="password"]').type(validPassword);
        cy.get('button[type="submit"]').click();

        // Asumsikan setelah login berhasil, pengguna akan diarahkan ke dashboard dengan URL /dashboard
        cy.get('.swal2-popup').should('be.visible').within(() => {
            cy.get('.swal2-title').should('contain', 'Mohon maaf username atau password salah');
        });
    });

    it('Periksa perilaku sistem ketika email yang valid dan kata sandi yang tidak valid dimasukkan', () => {
        cy.get('input[name="username"]').type(validUsername);
        cy.get('input[name="password"]').type(invalidPassword);
        cy.get('button[type="submit"]').click();

        // Asumsikan setelah login berhasil, pengguna akan diarahkan ke dashboard dengan URL /dashboard
        cy.get('.swal2-popup').should('be.visible').within(() => {
            cy.get('.swal2-title').should('contain', 'Mohon maaf username atau password salah');
        });
    });

    it('Periksa perilaku sistem ketika email tidak valid dan kata sandi tidak valid dimasukkan', () => {
        cy.get('input[name="username"]').type(invalidUsername);
        cy.get('input[name="password"]').type(invalidPassword);
        cy.get('button[type="submit"]').click();

        // Asumsikan ada pesan kesalahan dengan class .error-message
        cy.get('.swal2-popup').should('be.visible').within(() => {
            cy.get('.swal2-title').should('contain', 'Mohon maaf username atau password salah');
        });
    });
});
