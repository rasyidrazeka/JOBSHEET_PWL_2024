describe('Pengujian Website PSI | Administrasi', () => {
    const loginUrl = 'http://127.0.0.1:8000/'; // Ganti dengan URL login yang sesuai
    const validUsername = 'admin';
    const validPassword = 'admin123';

    beforeEach(() => {
        // Login sebelum setiap pengujian administrasi
        cy.visit(loginUrl);
        cy.get('input[name="username"]').type(validUsername);
        cy.get('input[name="password"]').type(validPassword);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/dashboard'); // Asumsikan setelah login berhasil diarahkan ke dashboard

        cy.get('.main-sidebar').should('be.visible');
        cy.get('#side-administrasi').click(); // Ganti dengan selector sidebar administrasi
        cy.url().should('include', '/administrasi'); // Ubah sesuai dengan URL halaman administrasi
        cy.get('h1').should('contain', 'Daftar Administrasi');
    });

    it('Cek sistem ketika aktor ingin memilih filter pada table data', () => {
        cy.get('#level_id').should('be.visible');
        cy.get('#level_id').select('2');
        cy.wait(2000);
        cy.get('#table_administrasi tbody tr').should('have.length', 1);
    })

    it('Cek sistem ketika aktor ingin memilih option show entries pada table data', () => {
        cy.get('#table_administrasi_length').should('be.visible');
        cy.get('select[name="table_administrasi_length"]').select('25');
        cy.wait(2000);
        cy.get('#table_administrasi tbody tr').should('have.length.lte', 25);
    })

    it('Cek sistem ketika aktor ingin mencari data pada tabel data', () => {
        cy.get('#table_administrasi_filter').should('be.visible');
        cy.get('#table_administrasi_filter input').type('widya');
        cy.wait(2000);
        cy.get('#table_administrasi tbody tr').should('have.length', 1);
    })

    it('Cek sistem ketika aktor ingin menambahkan data', () => {
        cy.get('.card-header').should('be.visible'); // Ganti dengan selector tombol tambah data
        cy.get('#btn-tambah-usr').click(); // Ganti dengan selector tombol tambah data
        cy.url().should('include', '/administrasi/create');

        cy.get('#tambah-administrasi').should('be.visible');
        cy.get('#level_id').select('1');
        cy.get('#level_id').should('have.value', '1');
        cy.get('#username').type('samsul');
        cy.get('#username').should('have.value', 'samsul');
        cy.get('#nama').type('samsul hadi');
        cy.get('#nama').should('have.value', 'samsul hadi');
        cy.get('#nik').type('2141762133');
        cy.get('#nik').should('have.value', '2141762133');
        cy.get('#jabatan').type('Mahasiswa');
        cy.get('#jabatan').should('have.value', 'Mahasiswa');
        cy.get('#password').type('samsul123');
        cy.get('#password').should('have.value', 'samsul123');

        cy.get('#tambah-administrasi').submit();
        cy.url().should('include', '/administrasi');
        cy.get('.swal2-popup').should('be.visible').within(() => {
            cy.get('.swal2-title').should('contain', 'Data administrasi berhasil ditambahkan');
        });
    })

    it('Cek sistem ketika aktor ingin menampilkan detail data', () => {
        cy.get('table#table_administrasi tbody tr').eq(3).find('#btn-detail').click();
        cy.get('h1').should('contain', 'Detail Administrasi');
    })

    it('Cek sistem ketika aktor ingin mengubah data', () => {
        cy.get('table#table_administrasi tbody tr').eq(3).find('#btn-edit').click();
        cy.get('h1').should('contain', 'Edit Administrasi');
        cy.get('#edit-administrasi').should('be.visible');
        cy.get('#level_id').select('2');
        cy.get('#level_id').should('have.value', '2');
        cy.get('#username').type(' cuy');
        cy.get('#username').should('have.value', 'samsul cuy');
        cy.get('#nama').type(' cuy');
        cy.get('#nama').should('have.value', 'samsul hadi cuy');
        cy.get('#nik').type('21');
        cy.get('#nik').should('have.value', '214176213321');
        cy.get('#jabatan').type(' cuy');
        cy.get('#jabatan').should('have.value', 'Mahasiswa cuy');

        cy.get('#edit-administrasi').submit();
        cy.url().should('include', '/administrasi');
        cy.get('.swal2-popup').should('be.visible').within(() => {
            cy.get('.swal2-title').should('contain', 'Data administrasi berhasil diubah');
        });
    })

    it('Cek sistem ketika aktor ingin menghapus data', () => {
        cy.get('table#table_administrasi tbody tr').eq(3).find('#btn-hapus').click();
        cy.url().should('include', '/administrasi');
        cy.get('.swal2-popup').should('be.visible').within(() => {
            cy.get('.swal2-title').should('contain', 'Data administrasi berhasil dihapus');
        });
    })
});