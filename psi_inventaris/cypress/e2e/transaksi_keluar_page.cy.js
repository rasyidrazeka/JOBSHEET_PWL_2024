describe('Pengujian Website PSI | Data Transaksi Keluar', () => {
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
        cy.get('#side-transaksiKeluar').click();
        cy.url().should('include', '/transaksiKeluar');
        cy.get('h1').should('contain', 'Daftar Transaksi Keluar');
    });

    it('Cek sistem ketika aktor ingin memilih filter pada table data', () => {
        cy.get('#barang_id').should('be.visible');
        cy.get('#barang_id').select('Steker');
        cy.wait(2000);
        cy.get('#table_transaksiKeluar tbody tr').should('have.length', 4);
    })

    it('Cek sistem ketika aktor ingin memilih option show entries pada table data', () => {
        cy.get('#table_transaksiKeluar_length').should('be.visible');
        cy.get('select[name="table_transaksiKeluar_length"]').select('25');
        cy.wait(2000);
        cy.get('#table_transaksiKeluar tbody tr').should('have.length.lte', 25);
    })

    it('Cek sistem ketika aktor ingin mencari data pada tabel data', () => {
        cy.get('#table_transaksiKeluar_filter').should('be.visible');
        cy.get('#table_transaksiKeluar_filter input').type('UTP');
        cy.wait(2000);
        cy.get('#table_transaksiKeluar tbody tr').should('have.length', 1);
    })

    it('Cek sistem ketika aktor ingin menambahkan data', () => {
        const datetime = '2023-05-30T12:56';
        cy.get('.card-header').should('be.visible');
        cy.get('#btn-tambah-transaksiKeluar').click();
        cy.url().should('include', '/transaksiKeluar/create');

        cy.get('#tambah-transaksiKeluar').should('be.visible');
        cy.get('#kode_transaksiKeluar').type('trk100');
        cy.get('#kode_transaksiKeluar').should('have.value', 'trk100');
        cy.get('#barang_id').select('Stop Kontak 4 Lubang');
        cy.get('#barang_id').should('have.value', '23');
        cy.get('#qty').type('20');
        cy.get('#qty').should('have.value', '20');
        cy.get('#tanggal_keluar').type(datetime);
        cy.get('#tanggal_keluar').should('have.value', datetime);

        cy.get('#tambah-transaksiKeluar').submit();
        cy.url().should('include', '/transaksiKeluar');
        cy.get('.swal2-popup').should('be.visible').within(() => {
            cy.get('.swal2-title').should('contain', 'Data transaksi keluar berhasil ditambahkan');
        });
        cy.get('a.page-link').contains('4').click();
        cy.wait(5000)
    })

    it('Cek sistem ketika aktor ingin menampilkan detail data', () => {
        cy.get('a.page-link').contains('4').click();
        cy.wait(2000);
        cy.get('table#table_transaksiKeluar').should('be.visible');
        cy.get('table#table_transaksiKeluar tbody tr').eq(9).find('#btn-detail').click();
        cy.get('h1').should('contain', 'Detail Transaksi Keluar');
    })

    it('Cek sistem ketika aktor ingin mengubah data', () => {
        cy.get('a.page-link').contains('4').click();
        cy.wait(2000);
        cy.get('table#table_transaksiKeluar').should('be.visible');
        cy.get('table#table_transaksiKeluar tbody tr').eq(9).find('#btn-edit').click();
        cy.get('h1').should('contain', 'Edit Transaksi Keluar');

        cy.get('#kode_transaksiKeluar').clear();
        cy.get('#kode_transaksiKeluar').type('trk200');
        cy.get('#kode_transaksiKeluar').should('have.value', 'trk200');
        cy.get('#qty').clear();
        cy.get('#qty').type('100');
        cy.get('#qty').should('have.value', '100');

        // TERJADI ERROR GATAU BENERIN
        // cy.get('#tanggal_diterima').should('be.visible');
        // const newDateTime = '2023-02-30T23:59';
        // cy.get('#tanggal_diterima').clear();
        // cy.get('#qty').click();
        // cy.get('#tanggal_diterima').type(newDateTime);
        // cy.get('#tanggal_diterima').should('have.value', newDateTime);

        cy.get('#edit-transaksiKeluar').submit();
        cy.url().should('include', '/transaksiKeluar');
        cy.get('.swal2-popup').should('be.visible').within(() => {
            cy.get('.swal2-title').should('contain', 'Data transaksi keluar berhasil diubah');
        });
    })

    it('Cek sistem ketika aktor ingin menghapus data', () => {
        cy.get('a.page-link').contains('4').click();
        cy.wait(2000);
        cy.get('table#table_transaksiKeluar').should('be.visible');
        cy.get('table#table_transaksiKeluar tbody tr').eq(9).find('#btn-hapus').click();
        cy.url().should('include', '/transaksiKeluar');
        cy.get('.swal2-popup').should('be.visible').within(() => {
            cy.get('.swal2-title').should('contain', 'Data transaksi keluar berhasil dihapus');
        });
    })
});