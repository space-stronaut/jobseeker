@extends('layouts.carreer')

@section('title')
    Job Offer
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('mazer/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/css/pages/datatables.css') }}">
@endpush
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            {{-- <a href="{{ route('job.create') }}" class="btn btn-primary">+ Create Offer</a> --}}
            Lamaran Tersedia
        </div>
        <div class="card-body">
            @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <table class="table" id="table1">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Posisi</th>
                        <th>Min GPA</th>
                        <th>Min Semester</th>
                        <th>Min Pengalaman kerja</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $item)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->posisi }}</td>
                            <td>>= {{ $item->gpa }}</td>
                            <td>>= {{ $item->semester }}</td>
                            <td>>= {{ $item->pengalaman_kerja }}</td>
                            <td>
                                <span class="badge text-uppercase text-bg-{{ $item->status == "close" ? "danger" : "success" }}">{{ $item->status }}</span>
                            </td>
                            <td class="d-flex justify-content-evenly">
                                {{-- @if (Auth::user()->role == "admin")
                                <div>
                                    <a href="{{ route('job.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                </div>
                                <div>
                                    <form action="{{ route('job.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                                @endif --}}
                                <div>
                                    <a href="{{ route('kandidatoffer.show', $item->id) }}" class="btn btn-info text-black">{{ Auth::user()->role != "pelamar" ? 'Detail' : 'Lamar' }}</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th>No Data</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('mazer/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('mazer/assets/js/pages/datatables.js') }}"></script>
@endpush