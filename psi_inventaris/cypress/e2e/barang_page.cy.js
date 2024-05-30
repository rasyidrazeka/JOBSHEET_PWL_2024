describe('Pengujian Website PSI | Data Barang', () => {
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
    cy.get('#side-barang').click(); // Ganti dengan selector sidebar administrasi
    cy.url().should('include', '/barang'); // Ubah sesuai dengan URL halaman administrasi
    cy.get('h1').should('contain', 'Daftar Barang');
  });

  it('Cek option show entries pada table data', () => {
    cy.get('#table_barang_length').should('be.visible');
    cy.get('select[name="table_barang_length"]').select('25');
    cy.get('#table_barang tbody tr').should('have.length.lte', 25);
  })

  it('Cek fitur search pada tabel data', () => {
    cy.get('#table_barang_filter').should('be.visible');
    cy.get('#table_barang_filter input').type('PALO');
    cy.get('#table_barang tbody tr').should('have.length', 2);
  })

  it('Cek sistem ketika aktor ingin menambahkan data', () => {
    cy.get('.card-header').should('be.visible'); // Ganti dengan selector tombol tambah data
    cy.get('#btn-tambah-barang').click(); // Ganti dengan selector tombol tambah data
    cy.url().should('include', '/barang/create');

    cy.get('#tambah-barang').should('be.visible');
    cy.get('#barang_kode').type('br100');
    cy.get('#barang_kode').should('have.value', 'br100');
    cy.get('#barang_nama').type('colokan');
    cy.get('#barang_nama').should('have.value', 'colokan');
    cy.get('#merk').type('palo');
    cy.get('#merk').should('have.value', 'palo');
    cy.get('#spesifikasi').type('colokan palo waw');
    cy.get('#spesifikasi').should('have.value', 'colokan palo waw');
    cy.get('#satuan').type('pack');
    cy.get('#satuan').should('have.value', 'pack');
    cy.get('#harga_satuan').type('16000');
    cy.get('#harga_satuan').should('have.value', '16000');

    cy.get('#tambah-barang').submit();
    cy.url().should('include', '/barang');
    cy.get('.swal2-popup').should('be.visible').within(() => {
      cy.get('.swal2-title').should('contain', 'Data barang berhasil ditambahkan');
    });
  })

  it('Cek sistem ketika aktor ingin menampilkan detail data', () => {
    cy.get('#table_barang_paginate').find('#table_barang_next').click();
    cy.get('table#table_barang tbody tr').eq(7).find('#btn-detail').click();
    cy.get('h1').should('contain', 'Detail Barang');
  })

  it('Cek sistem ketika aktor ingin mengubah data', () => {
    cy.get('table#table_barang tbody tr').eq(3).find('#btn-edit').click();
    cy.get('h1').should('contain', 'Edit Barang');
    cy.get('#barang_kode').type('1');
    cy.get('#barang_kode').should('have.value', 'br1001');
    cy.get('#barang_nama').type(' cuy');
    cy.get('#barang_nama').should('have.value', 'colokan cuy');
    cy.get('#merk').type(' cuy');
    cy.get('#merk').should('have.value', 'palo cuy');
    cy.get('#spesifikasi').type(' cuy');
    cy.get('#spesifikasi').should('have.value', 'colokan palo waw cuy');
    cy.get('#satuan').type(' cuy');
    cy.get('#satuan').should('have.value', 'pack cuy');
    cy.get('#harga_satuan').type('1');
    cy.get('#harga_satuan').should('have.value', '160001');

    cy.get('#edit-barang').submit();
    cy.url().should('include', '/barang');
    cy.get('.swal2-popup').should('be.visible').within(() => {
      cy.get('.swal2-title').should('contain', 'Data barang berhasil diubah');
    });
  })

  it('Cek sistem ketika aktor ingi menghapus data', () => {
    cy.get('table#table_barang tbody tr').eq(3).find('#btn-hapus').click();
    cy.url().should('include', '/barang');
    cy.get('.swal2-popup').should('be.visible').within(() => {
      cy.get('.swal2-title').should('contain', 'Data barang berhasil dihapus');
    });
  })
});