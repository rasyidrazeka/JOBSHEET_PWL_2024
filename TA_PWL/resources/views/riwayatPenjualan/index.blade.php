@extends('layouts.template')
@section('title', 'Riwayat Penjualan')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-1 control-label col-foem-label">Filter:</div>
                        <div class="col-3">
                            <select class="form-control" id="kategori_id" name="kategori_id" required>
                                <option value="">- Kategori -</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->kategori_id }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Kategori Produk</small>
                        </div>
                    </div>
                </div>
            </div> --}}
            <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="text-center">Tanggal Transaksi</th>
                        <th class="text-center">Kasir</th>
                        <th class="text-center">Nama Pelanggan</th>
                        <th class="text-center">Total Harga</th>
                        <th class="text-center">Metode Pembayaran</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $(document).ready(function() {
            var dataPenjualan = $('#table_penjualan').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('riwayatPenjualan/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    // "data": function(d) {
                    //     d.kategori_id = $('#kategori_id').val();
                    // }
                },
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "created_at",
                    name: "created_at",
                    render: function(data, type, row) {
                        return moment(data).format('DD-MMMM-YYYY HH:mm');
                    },
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                }, {
                    data: "user.nama_lengkap",
                    className: "",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                }, {
                    data: "customer.nama_lengkap",
                    className: "",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: false // searchable: true, jika ingin kolom ini bisa dicari
                }, {
                    data: "jumlah_total",
                    className: "text-center",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: false // searchable: true, jika ingin kolom ini bisa dicari
                }, {
                    data: "metode_pembayaran.nama_metode",
                    className: "text-center",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: false // searchable: true, jika ingin kolom ini bisa dicari
                }, {
                    data: "aksi",
                    className: "text-center",
                    orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: false // searchable: true, jika ingin kolom ini bisa dicari 
                }]
            });
            // $('#kategori_id').on('change', function() {
            //     dataProduk.ajax.reload();
            // })
        });
    </script>
@endpush
