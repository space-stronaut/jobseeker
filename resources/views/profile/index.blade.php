@extends('layouts.fe')

@section('title')
    Profil Saya
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('home') }}" class="btn btn-primary">Back</a>
    </div>
    <div class="card-body">
        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
        <form action="{{ route('profile.update', Auth::user()->id) }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="status" value="open">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" id="" class="form-control mt-2">
            </div>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" id="" class="form-control mt-2">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" id="" class="form-control mt-2">
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <input type="text" name="alamat" value="{{ Auth::user()->alamat }}" id="" class="form-control mt-2">
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin</label>
                {{-- <input type="email" name="email" value="{{ Auth::user()->email }}" id="" class="form-control mt-2"> --}}
                <input type="radio" name="jenis_kelamin" value="L" id="" {{ Auth::user()->jenis_kelamin == "L" ? 'checked' : "" }}>L
                    <input type="radio" name="jenis_kelamin" value="P" id="" {{ Auth::user()->jenis_kelamin == "P" ? 'checked' : "" }}>P
            </div>
            <div class="form-group">
                <button class="btn btn-primary mt-2">Submit</button>
                {{-- <label for="">Posisi</label> --}}
                {{-- <input type="text" name="posisi" id="" class="form-control mt-2"> --}}
            </div>
        </form>
    </div>
</div>
@endsection