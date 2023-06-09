@extends('layouts.fe')

@section('title')
    User Management
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('mazer/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/css/pages/datatables.css') }}">
@endpush
@section('content')
    <div class="card">
        {{-- @if (Auth::user()->role == "admin")
        <div class="card-header">
            <a href="{{ route('job.create') }}" class="btn btn-primary">+ Create Offer</a>
        </div>
        @endif --}}
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
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $item)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td class="text-uppercase">{{ $item->role }}</td>
                            <td class="d-flex justify-content-evenly">
                                {{-- <div> --}}
                                    @if ($item->role == "pelamar")
                                    <div>
                                        <form action="{{ route('user.update', $item->id) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" name="role" value="hr">
                                            <button class="btn btn-success">Jadikan HR</button>
                                        </form>
                                    </div>
                                    <div>
                                        <form action="{{ route('user.update', $item->id) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" name="role" value="tm">
                                            <button class="btn btn-success">Jadikan TM</button>
                                        </form>
                                    </div>
                                    <div>
                                        <form action="{{ route('user.update', $item->id) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" name="role" value="admin">
                                            <button class="btn btn-success">Jadikan Admin</button>
                                        </form>
                                    </div>
                                    @elseif($item->role == "hr")
                                    <div>
                                    <form action="{{ route('user.update', $item->id) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="role" value="pelamar">
                                        <button class="btn btn-success">Jadikan Pelamar</button>
                                    </form>
                                    </div>
                                    <div>
                                    <form action="{{ route('user.update', $item->id) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="role" value="tm">
                                        <button class="btn btn-success">Jadikan TM</button>
                                    </form>
                                    </div>
                                    <div>
                                    <form action="{{ route('user.update', $item->id) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="role" value="admin">
                                        <button class="btn btn-success">Jadikan Admin</button>
                                    </form>
                                    </div>
                                    @elseif($item->role == "tm")
                                    <div>
                                    <form action="{{ route('user.update', $item->id) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="role" value="hr">
                                        <button class="btn btn-success">Jadikan HR</button>
                                    </form>
                                    </div>
                                    <div>
                                    <form action="{{ route('user.update', $item->id) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="role" value="pelamar">
                                        <button class="btn btn-success">Jadikan Pelamar</button>
                                    </form>
                                    </div>
                                    <div>
                                    <form action="{{ route('user.update', $item->id) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="role" value="admin">
                                        <button class="btn btn-success">Jadikan Admin</button>
                                    </form>
                                    </div>
                                    @else
                                    <div>
                                    <form action="{{ route('user.update', $item->id) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="role" value="hr">
                                        <button class="btn btn-success">Jadikan HR</button>
                                    </form>
                                    </div>
                                    <div>
                                    <form action="{{ route('user.update', $item->id) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="role" value="tm">
                                        <button class="btn btn-success">Jadikan TM</button>
                                    </form>
                                    </div>
                                    <div>
                                    <form action="{{ route('user.update', $item->id) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="role" value="pelamar">
                                        <button class="btn btn-success">Jadikan Pelamar</button>
                                    </form>
                                    </div>
                                    @endif
                                    <div>
                                        <form action="{{ route('user.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                {{-- </div> --}}
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