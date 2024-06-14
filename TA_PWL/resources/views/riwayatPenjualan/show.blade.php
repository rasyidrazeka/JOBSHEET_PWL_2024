@extends('layouts.template')
@section('title', 'Tampil Riwayat Penjualan')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($penjualan)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $penjualan->penjualan_id }}</td>
                    </tr>
                    <tr>
                        <th>Kasir</th>
                        <td>{{ $penjualan->user->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <td>{{ $penjualan->customer->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Total Pembelian</th>
                        <td>{{ $penjualan->jumlah_total }}</td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>{{ $penjualan->metode_pembayaran->nama_metode }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('riwayatPenjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
