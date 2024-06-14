@extends('layouts.template')
@section('title', 'Tambah User')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('user') }}" class="form-horizontal" enctype="multipart/form-data"
                id="tambah-user">
                @csrf
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Username</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ old('username') }}" required>
                    </div>
                    @error('username')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Nama Lengkap</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                            value="{{ old('nama_lengkap') }}" required>
                    </div>
                    @error('nama_lengkap')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Email</label>
                    <div class="col-10">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                            required>
                    </div>
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">No HP</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                            required>
                    </div>
                    @error('no_hp')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Role</label>
                    <div class="col-10">
                        <select class="form-control" id="level_id" name="level_id" required>
                            <option>- Pilih Level -</option>
                            @foreach ($level as $item)
                                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Password</label>
                    <div class="col-10">
                        <input type="password" class="form-control" id="password" name="password"
                            value="{{ old('password') }}" required>
                    </div>
                    @error('password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('user') }}">Kembali</a>
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
