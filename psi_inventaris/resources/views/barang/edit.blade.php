@extends('layouts.template')
@section('title', 'Edit Data Barang')
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
                <a href="{{ url('barang') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/barang/' . $barang->barang_id) }}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Kode</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="barang_kode" name="barang_kode"
                                value="{{ old('barang_kode', $barang->barang_kode) }}" required>
                            @error('barang_kode')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Nama</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="barang_nama" name="barang_nama"
                                value="{{ old('barang_nama', $barang->barang_nama) }}" required>
                            @error('barang_nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Merk</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="merk" name="merk"
                                value="{{ old('merk', $barang->merk) }}" required>
                            @error('merk')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Spesifikasi</label>
                        <div class="col-11">
                            <input type="string" class="form-control" id="spesifikasi" name="spesifikasi"
                                value="{{ old('spesifikasi', $barang->spesifikasi) }}" required>
                            @error('spesifikasi')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Volume</label>
                        <div class="col-11">
                            <input type="string" class="form-control" id="volume" name="volume"
                                value="0" required>
                            @error('volume')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Satuan</label>
                        <div class="col-11">
                            <input type="string" class="form-control" id="satuan" name="satuan"
                                value="{{ old('satuan', $barang->satuan) }}" required>
                            @error('satuan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Harga Satuan</label>
                        <div class="col-11">
                            <input type="string" class="form-control" id="harga_satuan" name="harga_satuan"
                                value="{{ old('harga_satuan', $barang->harga_satuan) }}" required>
                            @error('harga_satuan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Gambar</label>
                        <div class="col-11">
                            <input type="file" id="gambar" name="gambar">
                            @error('gambar')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @else
                                <small class="form-text text-muted">Abaikan (jangan diisi) jika tidak ingin mengganti password
                                    user.</small>
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
            @endempty
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
