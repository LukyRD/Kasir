@extends('layouts.app')
@section('content-title', 'Profil')
@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column">
            @foreach ($errors->all() as $error)
            <li class="text-white my-2">{{ $error }}</li>
            @endforeach
        </div>
        @endif

        <form action="{{ route('edit-profil') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group my-2">
                        <label>Nama</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <div class="form-group my-2">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                    </div>

                    <div class="form-group my-2">
                        <label>Foto Profil</label><br>
                        @if(auth()->user()->foto)
                        <img src="{{ asset('storage/foto_user/' . auth()->user()->foto) }}" width="80"
                            class="mb-2 rounded shadow">
                        @endif
                        <input type="file" name="foto" class="form-control-file">
                        <small class="text-muted">Max 2MB. Format: jpg, png</small>
                    </div>
                </div>
                {{-- .col-md-6 --}}

                <div class="col-md-6">
                    <div class="form-group my-2">
                        <label>Password Lama</label>
                        <input type="password" name="old_password" class="form-control">
                        <small class="text-muted">Isi jika ingin mengubah password</small>
                    </div>

                    <div class="form-group my-2">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group my-2">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
                {{-- .col-md-6 --}}

            </div>
            {{-- .row --}}

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection