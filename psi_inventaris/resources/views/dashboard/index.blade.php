@extends('layouts.template')
@section('title', 'Dashboard')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Berikut ini merupakan dashboard dari sistem informasi inventaris BHP JTI POLINEMA</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $user->count() }}</h3>

                            <p>Data Administrasi</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-users" style="font-size: 75px"></i>
                        </div>
                        <a href="{{ url('administrasi') }}" class="small-box-footer">Selengkapnya&nbsp;&nbsp;&nbsp;<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 style="color: white">{{ $barang->count() }}</h3>

                            <p style="color: white">Data Barang</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-warehouse" style="font-size: 75px"></i>
                        </div>
                        <a href="{{ url('barang') }}" class="small-box-footer"
                            style="color: white !important">Selengkapnya&nbsp;&nbsp;&nbsp;<i
                                class="fas fa-arrow-circle-right" style="color: white"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $transaksi_masuk->count() }}</h3>

                            <p>Data Transaksi Masuk</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-circle-down" style="font-size: 75px"></i>
                        </div>
                        <a href="{{ url('transaksiMasuk') }}" class="small-box-footer">Selengkapnya&nbsp;&nbsp;&nbsp;<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $transaksi_keluar->count() }}</h3>

                            <p>Data Transaksi Keluar</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-circle-up" style="font-size: 75px"></i>
                        </div>
                        <a href="{{ url('transaksiKeluar') }}" class="small-box-footer">Selengkapnya&nbsp;&nbsp;&nbsp;<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card flex-fill w-100">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Data Administrasi Berdasarkan Level</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $administrasiChart->container() !!}
                            {{-- <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span>Data Barang Berdasarkan Volume</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="position-relative mb-4">
                            </div> --}}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-lg-6">
                    <div class="card flex-fill w-100">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Data Barang Berdasarkan Volume</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $barangChart->container() !!}
                            {{-- <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span>Data Barang Berdasarkan Volume</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->
                                <div class="position-relative mb-4">
                                </div> --}}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card flex-fill w-100">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Transaksi Masuk Berdasarkan Bulan dan Tahun</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $transaksiMasukChart->container() !!}
                            {{-- <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span>Data Barang Berdasarkan Volume</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->
                                <div class="position-relative mb-4">
                                </div> --}}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-lg-6">
                    <div class="card flex-fill w-100">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Transaksi Keluar Berdasarkan Bulan dan Tahun</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $transaksiKeluarChart->container() !!}
                            {{-- <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span>Data Barang Berdasarkan Volume</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->
                                <div class="position-relative mb-4">
                                </div> --}}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ $barangChart->cdn() }}"></script>
    {{ $barangChart->script() }}
    <script src="{{ $administrasiChart->cdn() }}"></script>
    {{ $administrasiChart->script() }}
    <script src="{{ $transaksiMasukChart->cdn() }}"></script>
    {{ $transaksiMasukChart->script() }}
    <script src="{{ $transaksiKeluarChart->cdn() }}"></script>
    {{ $transaksiKeluarChart->script() }}
@endpush
@push('css')
@endpush
