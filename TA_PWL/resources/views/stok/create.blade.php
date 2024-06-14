@extends('layouts.template')
@section('title', 'Tambah Iventaris')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('stok') }}" class="form-horizontal" enctype="multipart/form-data"
                id="tambah-stok">
                @csrf
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Nama Produk</label>
                    <div class="col-10">
                        <select class="form-control" id="produk_id" name="produk_id" required>
                            <option></option>
                            @foreach ($produk as $item)
                                <option value="{{ $item->produk_id }}">{{ $item->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Jumlah</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="perubahan_jumlah" name="perubahan_jumlah"
                            value="{{ old('perubahan_jumlah') }}" required>
                        @error('perubahan_jumlah')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Penanggung Jawab</label>
                    <div class="col-10">
                        <select class="form-control" id="user_id" name="user_id" required>
                            <option value=""></option>
                            @foreach ($user as $item)
                                <option value="{{ $item->user_id }}">{{ $item->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('stok') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    {{-- <script>
        $(document).ready(function() {
            $("#produk_id").select2({
                placeholder: '-Pilih Produk-'
            });
        });
        $(document).ready(function() {
            $("#user_id").select2({
                placeholder: '-Pilih Penanggung Jawab-'
            });
        });
    </script> --}}
@endpush
