@extends('layouts.template')
@section('title', 'Show Data Transaksi Masuk')
@section('content')
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($transaksi_masuk)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $transaksi_masuk->transaksiMasuk_id }}</td>
                    </tr>
                    <tr>
                        <th>Kode</th>
                        <td>{{ $transaksi_masuk->kode_transaksiMasuk }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $transaksi_masuk->barang->barang_nama }}</td>
                    </tr>
                    <tr>
                        <th>Merk</th>
                        <td>{{ $transaksi_masuk->barang->merk }}</td>
                    </tr>
                    <tr>
                        <th>Spesifikasi</th>
                        <td>{{ $transaksi_masuk->barang->spesifikasi }}</td>
                    </tr>
                    <tr>
                        <th>Gambar</th>
                        <td><img width="150px" src="{{ asset('storage/' . $transaksi_masuk->gambar) }}"></td>
                    </tr>
                    <tr>
                        <th>Volume</th>
                        <td>{{ $transaksi_masuk->qty }}</td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td>{{ $transaksi_masuk->barang->satuan }}</td>
                    </tr>
                    <tr>
                        <th>Total Harga</th>
                        <td>Rp {{ $total_harga = $transaksi_masuk->barang->harga_satuan * $transaksi_masuk->qty }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>{{ \Carbon\Carbon::parse($transaksi_masuk->tanggal_diterima)->format('d-M-Y H:m:s') }}</td>
                    </tr>
                </table>
            @endempty <a href="{{ url('transaksiMasuk') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
