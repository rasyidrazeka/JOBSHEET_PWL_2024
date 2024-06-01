@extends('layouts.template')
@section('title', 'Tambah Data Transaksi Masuk')
@section('content')
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools" style="width: 280px">
                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center">
                        Barang tidak ada?
                    </div>
                    <div class="col">
                        <a class="btn btn-sm btn-warning mt-1" href="{{ url('barang/create') }}">Tambah Barang</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('transaksiMasuk') }}" class="form-horizontal" enctype="multipart/form-data"
                id="tambah-transaksiMasuk">
                @csrf
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Kode</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="kode_transaksiMasuk" name="kode_transaksiMasuk"
                            value="{{ old('kode_transaksiMasuk') }}" required>
                        @error('kode_transaksiMasuk')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Nama Barang</label>
                    <div class="col-11">
                        <select class="form-control" id="barang_id" name="barang_id" required>
                            <option value="{{ old('barang_id') }}">- Pilih Barang -</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Volume</label>
                    <div class="col-11">
                        <input type="number" class="form-control" id="qty" name="qty" value="{{ old('qty') }}"
                            required>
                        @error('qty')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Gambar</label>
                    <div class="col-11">
                        <div class="col">
                            <div class="row">
                                <img class="img-preview img-fluid mb-2 col-sm-2">
                            </div>
                            <div class="row">
                                <input type="file" id="gambar" name="gambar" value="{{ old('gambar') }}" required
                                    onchange="previewImage()">
                                @error('gambar')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Tanggal Masuk</label>
                    <div class="col-11">
                        <input type="datetime-local" class="form-control" id="tanggal_diterima" name="tanggal_diterima"
                            value="{{ old('tanggal_diterima') }}" required>
                        @error('tanggal_diterima')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-warning btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('transaksiMasuk') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        function previewImage() {
            const gambar = document.querySelector('#gambar');
            const imgPreview = document.querySelector('.img-preview');
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(gambar.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
