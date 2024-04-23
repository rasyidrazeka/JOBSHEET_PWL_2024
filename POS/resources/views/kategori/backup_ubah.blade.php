@extends('layout.app')

{{-- Customize layout section --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Ubah')

{{-- Content body: main page content --}}
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Ubah Kategori</h3>
        </div>
        <form action="../ubah_simpan/{{$data->kategori_id}}" method="post">
            {{csrf_field()}}
            <div class="card-body">
                <div class="form-group">
                    <label for="kodeKategori">Kode Kategori</label>
                    <input type="text" class="form-control" name="kodeKategori" placeholder="Masukkan kode kategori" value="{{$data->kategori_kode}}">
                </div>
                <div class="form-group">
                    <label for="namaKategori">Nama Kategori</label>
                    <input type="text" class="form-control" name="namaKategori" placeholder="Masukkan nama kategori" value="{{$data->kategori_nama}}">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
        </form>
    </div>
@endsection