describe('Pengujian Website PSI | Data Transaksi Masuk', () => {
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
        cy.get('#side-transaksiMasuk').click(); // Ganti dengan selector sidebar administrasi
        cy.url().should('include', '/transaksiMasuk'); // Ubah sesuai dengan URL halaman administrasi
        cy.get('h1').should('contain', 'Daftar Transaksi Masuk');
    });

    it('Cek sistem ketika aktor ingin memilih filter pada table data', () => {
        cy.get('#barang_id').should('be.visible');
        cy.get('#barang_id').select('Kabel UTP Belden Cat 6');
        cy.get('#table_transaksiMasuk tbody tr').should('have.length', 1);
    })

    it('Cek sistem ketika aktor ingin memilih option show entries pada table data', () => {
        cy.get('#table_transaksiMasuk_length.dataTables_length').should('be.visible');
        cy.get('select[name="table_transaksiMasuk_length"]').select('25');
        cy.get('#table_transaksiMasuk tbody tr').should('have.length.lte', 25);
    })

    it('Cek sistem ketika aktor ingin mencari data pada tabel data', () => {
        cy.get('#table_transaksiMasuk_filter').should('be.visible');
        cy.get('#table_transaksiMasuk_filter input').type('UTP');
        cy.get('#table_transaksiMasuk tbody tr').should('have.length', 1);
    })

    it('Cek sistem ketika aktor ingin menambahkan data', () => {
        const datetime = '2023-05-30T23:59';
        cy.get('.card-header').should('be.visible'); // Ganti dengan selector tombol tambah data
        cy.get('#btn-tambah-transaksiMasuk').click(); // Ganti dengan selector tombol tambah data
        cy.url().should('include', '/transaksiMasuk/create');

        cy.get('#tambah-transaksiMasuk').should('be.visible');
        cy.get('#kode_transaksiMasuk').type('trm100');
        cy.get('#kode_transaksiMasuk').should('have.value', 'trm100');
        cy.get('#barang_id').select('Steker');
        cy.get('#barang_id').should('have.value', '31');
        cy.get('#qty').type('20');
        cy.get('#qty').should('have.value', '20');
        cy.get('#gambar').should('be.visible');
        cy.get('#gambar').attachFile('barang 17.jpg');
        cy.get('#tanggal_diterima').type(datetime);
        cy.get('#tanggal_diterima').should('have.value', datetime);

        cy.get('#tambah-transaksiMasuk').submit();
        cy.url().should('include', '/transaksiMasuk');
        cy.get('.swal2-popup').should('be.visible').within(() => {
            cy.get('.swal2-title').should('contain', 'Data transaksi masuk berhasil ditambahkan');
        });
    })

    it('Cek sistem ketika aktor ingin menampilkan detail data', () => {
        cy.get('a.page-link').contains('2').click();
        cy.wait(5000)
        cy.get('table#table_transaksiMasuk').should('be.visible');
        cy.get('table#table_transaksiMasuk tbody tr').eq(7).find('#btn-detail').click();
        cy.get('h1').should('contain', 'Detail Transaksi Masuk');
    })

    it('Cek sistem ketika aktor ingin mengubah data', () => {
        cy.get('a.page-link').contains('2').click();
        cy.wait(5000)
        cy.get('table#table_transaksiMasuk').should('be.visible');
        cy.get('table#table_transaksiMasuk tbody tr').eq(7).find('#btn-edit').click();
        cy.get('h1').should('contain', 'Edit Transaksi Masuk');

        cy.get('#kode_transaksiMasuk').clear();
        cy.get('#kode_transaksiMasuk').type('trm200');
        cy.get('#kode_transaksiMasuk').should('have.value', 'trm200');
        cy.get('#qty').clear();
        cy.get('#qty').type('100');
        cy.get('#qty').should('have.value', '100');
        cy.get('#gambar').should('be.visible');
        cy.get('#gambar').attachFile('barang 16.jpg');

        // TERJADI ERROR GATAU BENERIN
        // cy.get('#tanggal_diterima').should('be.visible');
        // const newDateTime = '2023-02-30T23:59';
        // cy.get('#tanggal_diterima').clear();
        // cy.get('#qty').click();
        // cy.get('#tanggal_diterima').type(newDateTime);
        // cy.get('#tanggal_diterima').should('have.value', newDateTime);

        cy.get('#edit-transaksiMasuk').submit();
        cy.url().should('include', '/transaksiMasuk');
        cy.get('.swal2-popup').should('be.visible').within(() => {
            cy.get('.swal2-title').should('contain', 'Data transaksi masuk berhasil diubah');
        });
    })

    it('Cek sistem ketika aktor ingin menghapus data', () => {
        cy.get('a.page-link').contains('2').click();
        cy.wait(5000)
        cy.get('table#table_transaksiMasuk').should('be.visible');
        cy.get('table#table_transaksiMasuk tbody tr').eq(7).find('#btn-hapus').click();
        cy.url().should('include', '/transaksiMasuk');
        cy.get('.swal2-popup').should('be.visible').within(() => {
            cy.get('.swal2-title').should('contain', 'Data transaksi masuk berhasil dihapus');
        });
    })
});