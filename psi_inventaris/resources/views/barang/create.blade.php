@extends('layouts.template')
@section('title', 'Tambah Data Barang')
@section('content')
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('barang') }}" class="form-horizontal" enctype="multipart/form-data" id="tambah-barang">
                @csrf
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Kode Barang</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="barang_kode" name="barang_kode"
                            value="{{old('barang_kode')}}" required>
                        @error('barang_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Nama Barang</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="barang_nama" name="barang_nama"
                            value="{{old('barang_nama')}}" required>
                        @error('barang_nama')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Merk</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="merk" name="merk" value="{{old('merk')}}"
                            required>
                        @error('merk')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Spesifikasi</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="spesifikasi" name="spesifikasi"
                            value="{{old('spesifikasi')}}" required>
                        @error('spesifikasi')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Volume</label>
                    <div class="col-11">
                        <input type="number" class="form-control" id="volume" name="volume"
                            value="0" required>
                        @error('volume')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div> --}}
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Satuan</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="satuan" name="satuan"
                            value="{{old('satuan')}}" required>
                        @error('satuan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Harga Satuan</label>
                    <div class="col-11">
                        <input type="number" class="form-control" id="harga_satuan" name="harga_satuan"
                            value="{{old('harga_satuan')}}" required>
                        @error('harga_satuan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Gambar</label>
                    <div class="col-11">
                        <input type="file" id="gambar" name="gambar" value="{{ old('gambar') }}" required>
                        @error('gambar')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div> --}}
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-warning btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('barang') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
