@extends('layouts.fe')

@section('title')
    Job Offer
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('job.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('job.store') }}" method="post">
                @csrf
                <input type="hidden" name="status" value="open">
                <div class="form-group">
                    <label for="">Posisi</label>
                    <input type="text" name="posisi" id="" class="form-control mt-2">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control"></textarea>
                    {{-- <input type="text" name="posisi" id="" class="form-control mt-2"> --}}
                </div>
                <div class="form-group">
                    <label for="">Min. GPA</label>
                    <input type="number" name="gpa" id="" class="form-control mt-2">
                </div>
                <div class="form-group">
                    <label for="">Min. Semester</label>
                    <input type="number" name="semester" id="" class="form-control mt-2">
                </div>
                <div class="form-group">
                    <label for="">Min. Pengalaman Kerja</label>
                    <input type="number" name="pengalaman_kerja" id="" class="form-control mt-2">
                </div>
                <div class="form-group">
                    <label for="">Responsible</label>
                    <textarea name="responsible" id="" cols="30" rows="10" class="form-control"></textarea>
                    {{-- <input type="text" name="posisi" id="" class="form-control mt-2"> --}}
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