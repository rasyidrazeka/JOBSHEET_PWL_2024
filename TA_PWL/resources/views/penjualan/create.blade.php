@extends('layouts.template')
@section('title', 'Tambah Transaksi Penjualan')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('penjualan') }}" class="form-horizontal" enctype="multipart/form-data"
                id="tambah-penjualan">
                @csrf
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Kasir</label>
                    <div class="col-10">
                        <select class="form-control" id="user_id" name="user_id" required>
                            <option>- Pilih Nama Kasir -</option>
                            @foreach ($user as $item)
                                <option value="{{ $item->user_id }}">{{ $item->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Pembeli</label>
                    <div class="col-10">
                        <select class="form-control" id="customer_id" name="customer_id" required>
                            <option>- Pilih Nama Pelanggan -</option>
                            @foreach ($customer as $item)
                                <option value="{{ $item->customer_id }}">{{ $item->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Produk</label>
                    <div class="col-10" id="produk-list">
                        @foreach ($produks as $produk)
                            <div class="form-group">
                                <label>{{ $produk->nama_produk }} (Harga : {{ $produk->harga }})</label>
                                <input type="hidden" name="produks[{{ $loop->index }}][produk_id]"
                                    value="{{ $produk->produk_id }}">
                                <input type="number" name="produks[{{ $loop->index }}][jumlah]" class="form-control"
                                    min="0" value="0">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Metode Pembayaran</label>
                    <div class="col-10">
                        <select class="form-control" id="metode_pembayaran_id" name="metode_pembayaran_id" required>
                            <option>- Pilih Metode Pembayaran -</option>
                            @foreach ($metode_pembayaran as $item)
                                <option value="{{ $item->metode_pembayaran_id }}">{{ $item->nama_metode }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
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
            $("#kategori_id").select2({
                placeholder: '-Pilih Kategori-'
            });
        });
    </script> --}}
@endpush
