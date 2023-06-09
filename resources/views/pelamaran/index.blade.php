@extends('layouts.fe')

@section('title')
    Pelamaran Saya
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('mazer/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/css/pages/datatables.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('job.index') }}" class="btn btn-primary">Cari Pekerjaan</a>
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
                        {{-- <th>Min GPA</th>
                        <th>Min Semester</th>
                        <th>Min Pengalaman kerja</th> --}}
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelamarans as $item)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->offer->posisi }}</td>
                            <td class="text-uppercase">
                                {{ $item->status }}
                            </td>
                            <td>
                                <a href="{{ route('job.show', $item->offer->id) }}" class="btn btn-info">Detail</a>
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
@endsection

@push('scripts')
<script src="{{ asset('mazer/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('mazer/assets/js/pages/datatables.js') }}"></script>
@endpush