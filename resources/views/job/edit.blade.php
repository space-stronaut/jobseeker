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
            <form action="{{ route('job.update', $job->id) }}" method="post">
                @csrf
                @method('put')
                {{-- <input type="hidden" name="status" value="{{  }}"> --}}
                <div class="form-group">
                    <label for="">Posisi</label>
                    <input type="text" name="posisi" id="" class="form-control mt-2" value="{{ $job->posisi }}" required>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control">{{ $job->deskripsi }}</textarea>
                    {{-- <input type="text" name="posisi" id="" class="form-control mt-2"> --}}
                </div>
                <div class="form-group">
                    <label for="">Min. GPA</label>
                    <input type="number" name="gpa" id="" class="form-control mt-2" value="{{ $job->gpa }}" required>
                </div>
                <div class="form-group">
                    <label for="">Min. Semester</label>
                    <input type="number" name="semester" id="" class="form-control mt-2" value="{{ $job->semester }}" required>
                </div>
                <div class="form-group">
                    <label for="">Min. Pengalaman Kerja</label>
                    <input type="number" name="pengalaman_kerja" id="" class="form-control mt-2" value="{{ $job->pengalaman_kerja }}" required>
                </div>
                <div class="form-group">
                    <label for="">Responsible</label>
                    <textarea name="responsible" id="" cols="30" rows="10" class="form-control" required>{{ $job->responsible }}</textarea>
                    {{-- <input type="text" name="posisi" id="" class="form-control mt-2"> --}}
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="" class="form-control" required>
                        <option value="">Choose Status...</option>
                        <option value="open" {{ $job->status == "open" ? 'selected' : "" }}>Open</option>
                        <option value="close" {{ $job->status == "close" ? 'selected' : "" }}>Close</option>
                    </select>
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