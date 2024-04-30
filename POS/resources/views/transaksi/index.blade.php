@extends('layout.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('transaksi/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover table-sm" id="table_transaksi">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            var dataTransaksi = $('#table_transaksi').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing 
                ajax: {
                    "url": "{{ url('transaksi/list') }}",
                    "dataType": "json",
                    "type": "POST"
                },
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn() 
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "penjualan.penjualan_kode",
                    className: "",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan 
                    searchable: true // searchable: true, jika ingin kolom ini bisa dicari 
                }, {
                    data: "barang.barang_nama",
                    className: "",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan 
                    searchable: true // searchable: true, jika ingin kolom ini bisa dicari 
                }, {
                    data: "jumlah",
                    className: "",
                    orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan 
                    searchable: false // searchable: true, jika ingin kolom ini bisa dicari 
                }, {
                    data: "barang.harga_jual",
                    className: "",
                    orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan 
                    searchable: false // searchable: true, jika ingin kolom ini bisa dicari 
                }, {
                    data: "aksi",
                    className: "text-center",
                    orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: false // searchable: true, jika ingin kolom ini bisa dicari 
                }]
            });
        });
    </script>
@endpush
