@extends('layouts.template')
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
                <a href="{{ url('transaksiKeluar') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/transaksiKeluar/' . $transaksi_keluar->transaksiKeluar_id)}}"
                    class="form-horizontal" enctype="multipart/form-data">
                    @csrf {!! method_field('PUT') !!}<!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Kode</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="kode_transaksiKeluar" name="kode_transaksiKeluar"
                                value="{{ old('kode_transaksiKeluar', $transaksi_keluar->kode_transaksiKeluar) }}" required>
                            @error('kode_transaksiKeluar')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Nama Barang</label>
                        <div class="col-11">
                            <select class="form-control" id="barang_id" name="barang_id" required>
                                <option value="">- Pilih Barang -</option>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->barang_id }}" @if ($item->barang_id == $transaksi_keluar->barang_id) selected @endif>
                                        {{ $item->barang_nama }}</option>
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
                            <input type="number" class="form-control" id="qty" name="qty"
                                value="{{ old('qty', $transaksi_keluar->qty) }}" required>
                            @error('qty')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tanggal Keluar</label>
                        <div class="col-11">
                            <input type="datetime-local" class="form-control" id="tanggal_keluar" name="tanggal_keluar"
                                value="{{ old('tanggal_keluar', $transaksi_keluar->tanggal_keluar) }}" required>
                            @error('tanggal_keluar')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-warning btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('transaksiKeluar') }}">Kembali</a>
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
