@extends('layouts.template')
@section('content')
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form id="filterForm">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-2 control-label col-form-label">Bulan:</label>
                            <div class="col-8">
                                <select name="bulan" id="bulan" class="form-control" required>
                                    <option value="">- SEMUA -</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">
                                            {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                                <small class="form-text text-muted">Bulan</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-2 control-label col-form-label">Tahun:</label>
                            <div class="col-8">
                                <select name="tahun" id="tahun" class="form-control" required>
                                    <option value="">- SEMUA -</option>
                                    @for ($i = 2023; $i <= date('Y'); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <small class="form-text text-muted">Tahun</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-warning">Filter</button>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-striped table-hover table-sm" id="table_pelaporan">
                <thead>
                    <tr class="text-center">
                        <th>Nama Barang</th>
                        <th>Barang Masuk</th>
                        <th>Barang Keluar</th>
                        <th>Sisa Barang</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            $('#filterForm').submit(function(e) {
                e.preventDefault();
                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();

                $('#table_pelaporan').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('pelaporan.filter') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            bulan: bulan,
                            tahun: tahun
                        }
                    },
                    columns: [{
                        data: 'nama_barang',
                        name: 'nama_barang'
                    }, {
                        data: 'barang_masuk',
                        name: 'barang_masuk'
                    }, {
                        data: 'barang_keluar',
                        name: 'barang_keluar'
                    }, {
                        data: 'sisa_barang',
                        name: 'sisa_barang'
                    }, {
                        data: 'total_harga',
                        name: 'total_harga'
                    }],
                    destroy: true // Add this to reinitialize the table with new data
                });
            });
        });
    </script>
@endpush
