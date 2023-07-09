@extends('layouts.fe')

@section('title')
    Job Offer
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('mazer/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/css/pages/datatables.css') }}">
@endpush
@section('content')
    <div class="card">
        @if (Auth::user()->role != "pelamar")
        <div class="card-header d-flex">
            <a href="{{ route('job.create') }}" class="btn btn-primary">+ Create Offer</a>
            <!-- Button trigger modal -->
<button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Cetak Rekapan
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Rekapan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('pelamar.cetak') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Tahap</label>
                <select name="type" id="" class="form-control">
                    <option value="">Pilih Tahap</option>
                    <option value="pelamaran diajukan">Pelamaran Diajukan</option>
                    <option value="lolos tahap pelamaran">Lolos tahap pelamaran</option>
                    <option value="telah upload jawaban">Telah upload jawaban</option>
                    <option value="lolos tahap ujian">Lolos tahap ujian</option>
                    <option value="pending interview">Pending interview</option>
                    <option value="diterima">Diterima</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Start Date</label>
                <input type="date" name="start" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">End Date</label>
                <input type="date" name="end" id="" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-primary mt-2">Print</button>
            </div>
        </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>
        </div>
        @endif
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
                                @if (Auth::user()->role == "admin")
                                <div>
                                    <a href="{{ route('job.edit', $item->id) }}" class="btn btn-warning text-black">Edit</a>
                                </div>
                                <div>
                                    <form action="{{ route('job.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger text-black" >Hapus</button>
                                    </form>
                                </div>
                                @endif
                                <div>
                                    <a href="{{ route('job.show', $item->id) }}" class="btn btn-info text-black">{{ Auth::user()->role != "pelamar" ? 'Detail' : 'Lamar' }}</a>
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
@endsection

@push('scripts')
<script src="{{ asset('mazer/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('mazer/assets/js/pages/datatables.js') }}"></script>
@endpush