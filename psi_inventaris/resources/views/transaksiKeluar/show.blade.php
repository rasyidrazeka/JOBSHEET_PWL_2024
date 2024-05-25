@extends('layouts.template')
@section('title', 'Show Data Transaksi Keluar')
@section('content')
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($transaksi_keluar)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $transaksi_keluar->transaksiKeluar_id }}</td>
                    </tr>
                    <tr>
                        <th>Kode</th>
                        <td>{{ $transaksi_keluar->kode_transaksiKeluar }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $transaksi_keluar->barang->barang_nama }}</td>
                    </tr>
                    <tr>
                        <th>Merk</th>
                        <td>{{ $transaksi_keluar->barang->merk }}</td>
                    </tr>
                    <tr>
                        <th>Spesifikasi</th>
                        <td>{{ $transaksi_keluar->barang->spesifikasi }}</td>
                    </tr>
                    <tr>
                        <th>Volume</th>
                        <td>{{ $transaksi_keluar->qty }}</td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td>{{ $transaksi_keluar->barang->satuan }}</td>
                    </tr>
                    <tr>
                        <th>Total Harga</th>
                        <td>Rp {{ $total_harga = $transaksi_keluar->barang->harga_satuan * $transaksi_keluar->qty }}</td>
                    </tr>
                    <tr>
                        <th>Sisa Barang</th>
                        <td>{{ $transaksi_keluar->barang->volume }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Keluar</th>
                        <td>{{ \Carbon\Carbon::parse($transaksi_keluar->tanggal_keluar)->format('d-M-Y H:m:s') }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('transaksiKeluar') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
