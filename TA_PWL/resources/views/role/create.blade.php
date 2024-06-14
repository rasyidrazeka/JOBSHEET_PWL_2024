@extends('layouts.template')
@section('title', 'Tambah Role')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('role') }}" class="form-horizontal" enctype="multipart/form-data"
                id="tambah-role">
                @csrf
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Role</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="level_nama" name="level_nama"
                            value="{{ old('level_nama') }}" required>
                    </div>
                    @error('level_nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('role') }}">Kembali</a>
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
