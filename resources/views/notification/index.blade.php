@extends('layouts.fe')

@section('title')
    My Notification
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('mazer/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/css/pages/datatables.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table" id="table1">
                <thead class="thead-dark">
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notifications as $item)
                        <tr>
                            {{-- <th>{{ $loop->iteration }}</th> --}}
                            <td>{{ $item->message }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th>No Message</th>
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