@extends('layouts.template')
@section('title', 'Tampil Produk')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($produk)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $produk->produk_id }}</td>
                    </tr>
                    <tr>
                        <th>Nama Produk</th>
                        <td>{{ $produk->nama_produk }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $produk->kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $produk->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>{{ $produk->harga }}</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>{{ $produk->stok }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('produk') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
