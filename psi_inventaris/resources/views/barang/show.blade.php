@extends('layouts.template')

@section('content')
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($barang)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $barang->barang_id }}</td>
                    </tr>
                    <tr>
                        <th>Kode</th>
                        <td>{{ $barang->barang_kode }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $barang->barang_nama }}</td>
                    </tr>
                    <tr>
                        <th>Merk</th>
                        <td>{{ $barang->merk }}</td>
                    </tr>
                    <tr>
                        <th>Spesifikasi</th>
                        <td>{{ $barang->spesifikasi }}</td>
                    </tr>
                    <tr>
                        <th>Volume</th>
                        <td>{{ $barang->volume }}</td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td>{{ $barang->satuan }}</td>
                    </tr>
                    <tr>
                        <th>Harga Satuan</th>
                        <td>Rp {{ $barang->harga_satuan }}</td>
                    </tr>
                    {{-- <tr>
                        <th>Gambar</th>
                        <td><img width="150px" src="{{ url('/img_barang/' . $barang->gambar) }}"></td>
                    </tr> --}}
                </table>
            @endempty
            <a href="{{ url('barang') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
