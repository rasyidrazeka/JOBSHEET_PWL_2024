@extends('layouts.template')
@section('title', 'Edit Data Transaksi Masuk')
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
                <a href="{{ url('transaksiMasuk') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/transaksiMasuk/' . $transaksi_masuk->transaksiMasuk_id) }}"
                    class="form-horizontal" enctype="multipart/form-data" id="edit-transaksiMasuk">
                    @csrf {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Kode</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="kode_transaksiMasuk" name="kode_transaksiMasuk"
                                value="{{ old('kode_transaksiMasuk', $transaksi_masuk->kode_transaksiMasuk) }}" required>
                            @error('kode_transaksiMasuk')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Nama Barang</label>
                        <div class="col-11">
                            <select class="form-control" id="barang_id" name="barang_id" disabled>
                                <option value="">- Pilih Barang -</option>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->barang_id }}" @if ($item->barang_id == $transaksi_masuk->barang_id) selected @endif>
                                        {{ $item->barang_nama }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="barang_id" value="{{ $transaksi_masuk->barang_id }}">
                            @error('barang_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Volume</label>
                        <div class="col-11">
                            <input type="number" class="form-control" id="qty" name="qty"
                                value="{{ old('qty', $transaksi_masuk->qty) }}" required>
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
                                    @if ($transaksi_masuk->gambar)
                                        <img src="{{ asset('storage/' . $transaksi_masuk->gambar) }}"
                                            class="img-preview img-fluid mb-2 col-sm-2">
                                    @else
                                        <img class="img-preview img-fluid mb-2 col-sm-2">
                                    @endif
                                </div>
                                <div class="row">
                                    <input type="hidden" name="oldImage" value="{{ $transaksi_masuk->gambar }}">
                                    <input type="file" id="gambar" name="gambar" onchange="previewImage()">
                                    @error('gambar')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @else
                                        <small class="form-text text-muted">Abaikan (jangan diisi) jika tidak ingin mengganti
                                            gambar
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tanggal Masuk</label>
                        <div class="col-11">
                            <input type="datetime-local" class="form-control" id="tanggal_diterima" name="tanggal_diterima"
                                value="{{ old('tanggal_diterima', $transaksi_masuk->tanggal_diterima) }}" required>
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
            @endempty
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
