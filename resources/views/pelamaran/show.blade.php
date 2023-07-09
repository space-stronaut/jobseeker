@extends('layouts.fe')

@section('title')
    Detail Pelamaran
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('job.show', $pelamaran->offer_id) }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nama Pelamar</th>
                    <th>:</th>
                    <td>
                        {{ $pelamaran->user->name }}
                    </td>
                </tr>
                <tr>
                    <th>GPA</th>
                    <th>:</th>
                    <td>
                        <div class="text-uppercase">{{ $pelamaran->gpa }} - {{ $pelamaran->status_gpa }}</div>
                    </td>
                </tr>
                <tr>
                    <th>Semester</th>
                    <th>:</th>
                    <td>
                        <div class="text-uppercase">{{ $pelamaran->isFreshGraduate == 1 ? "Fresh Graduate" : $pelamaran->semester . " - " . $pelamaran->status_semester}}</div>
                    </td>
                </tr>
                <tr>
                    <th>Pengalaman Kerja</th>
                    <th>:</th>
                    <td>
                        {{ $pelamaran->pengalaman_kerja }} - <span class="text-uppercase">{{ $pelamaran->status_pengalaman_kerja}}</span>
                        {{-- <div class="text-uppercase">{{ $pelamaran->isFreshGraduate == 1 ? "Fresh Graduate" : $pelamaran->pengalaman_kerja . " - " . $pelamaran->status_pengalaman_kerja}}</div> --}}
                    </td>
                </tr>
                <tr>
                    <th>Deskripsi Pelamar</th>
                    <th>:</th>
                    <td>
                        {{ $pelamaran->deskripsi_pelamar }}
                    </td>
                </tr>
                <tr>
                    <th>Institusi/Universitas</th>
                    <th>:</th>
                    <td>
                        {{ $pelamaran->institution }}
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <th>:</th>
                    <td class="text-uppercase">
                        {{ $pelamaran->status }}
                    </td>
                </tr>
                <tr>
                    <th>CV</th>
                    <th>:</th>
                    <td>
                        <a href="{{ route('pelamaran.download', $pelamaran->id) }}" class="btn btn-info">Download CV</a>
                    </td>
                </tr>
                @if ($pelamaran->status == "lolos tahap ujian")
                <tr>
                    <th>Skor Ujian</th>
                    <th>:</th>
                    <td>
                        {{-- <a href="{{ route('pelamaran.download', $pelamaran->id) }}" class="btn btn-info">Download CV</a> --}}
                        {{App\Models\Ujian::where('pelamaran_id', $pelamaran->id)->get()[0]->nilai}}
                    </td>
                </tr>
                @elseif($pelamaran->status == "pending interview")
                <tr>
                    <th>Skor Ujian</th>
                    <th>:</th>
                    <td>
                        {{-- <a href="{{ route('pelamaran.download', $pelamaran->id) }}" class="btn btn-info">Download CV</a> --}}
                        {{App\Models\Ujian::where('pelamaran_id', $pelamaran->id)->get()[0]->nilai}}
                    </td>
                </tr>
                @elseif($pelamaran->status == "diterima")
                <tr>
                    <th>Skor Ujian</th>
                    <th>:</th>
                    <td>
                        {{-- <a href="{{ route('pelamaran.download', $pelamaran->id) }}" class="btn btn-info">Download CV</a> --}}
                        {{App\Models\Ujian::where('pelamaran_id', $pelamaran->id)->get()[0]->nilai}}
                    </td>
                </tr>
                <tr>
                    <th>Skor Interview</th>
                    <th>:</th>
                    <td>
                        {{-- <a href="{{ route('pelamaran.download', $pelamaran->id) }}" class="btn btn-info">Download CV</a> --}}
                        {{App\Models\Interview::where('pelamaran_id', $pelamaran->id)->get()[0]->nilai}}
                    </td>
                </tr>
                @elseif($pelamaran->status == "gagal tahap ujian" || $pelamaran->status == "gagal tahap interview" || $pelamaran->status == "tidak diterima interview")
                <tr>
                    <th>Skor Ujian</th>
                    <th>:</th>
                    <td>
                        {{-- <a href="{{ route('pelamaran.download', $pelamaran->id) }}" class="btn btn-info">Download CV</a> --}}
                        {{App\Models\Ujian::where('pelamaran_id', $pelamaran->id)->get()[0]->nilai}}
                    </td>
                </tr>
                <tr>
                    <th>Skor Interview</th>
                    <th>:</th>
                    <td>
                        {{-- <a href="{{ route('pelamaran.download', $pelamaran->id) }}" class="btn btn-info">Download CV</a> --}}
                        {{App\Models\Interview::where('pelamaran_id', $pelamaran->id)->get()[0]->nilai}}
                    </td>
                </tr>
                @endif
            </table>
            @if ($pelamaran->status == 'pelamaran diajukan' && Auth::user()->role == "hr")
            <div class="d-flex">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tetapkan Sebagai Lolos Tahap Pelamaran
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Submit File Soal</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('ujian.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="pelamaran_id" value="{{ $pelamaran->id }}">
                                <input type="hidden" name="status" value="lolos tahap pelamaran">
                                <input type="file" name="file_soal" id="" class="form-control" accept=".pdf" required>
                                <input type="date" name="batas_pengerjaan" id="" class="form-control" required>
                                <button class="btn btn-primary mt-3">Submit Soal</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    {{-- <a href="" class="btn btn-danger">Tetapkan Sebagai Gagal Tahap Pelamaran</a> --}}
                    <form action="{{ route('pelamaran.update', $pelamaran->id) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="status" value="gagal tahap pelamaran">
                        <button class="btn btn-danger ms-2">Tetapkan Sebagai Gagal Tahap Pelamaran</button>
                    </form>
                </div>
            @elseif($pelamaran->status == "lolos tahap pelamaran" && Auth::user()->role == "hr")
            <table class="table">
                <tr>
                <th>Batas Pengerjaan</th>
                <th>:</th>
                <td>{{App\Models\Ujian::where('pelamaran_id', $pelamaran->id)->get()[0]->batas_pengerjaan}}</td>
            </tr>
            <tr>
                <th>Status</th>
                <th>:</th>
                <td>Belum Dikerjakan</td>
            </tr>
            </table>
            <form action="{{ route('ujian.batas', App\Models\Ujian::where('pelamaran_id', $pelamaran->id)->get()[0]->id) }}" method="post">
                @csrf
                @method('put')
                <label for="">Batas Pengerjaan</label>
                <input type="date" name="batas_pengerjaan" value="{{ App\Models\Ujian::where('pelamaran_id', $pelamaran->id)->get()[0]->batas_pengerjaan }}" required id="" class="form-control">
                <button class="btn btn-success">Ubah Batas Pengerjaan</button>
            </form>
            @elseif($pelamaran->status == "telah upload jawaban" && Auth::user()->role == "tm")
            <table class="table">
                <tr>
                    <th>File Jawaban</th>
                    <th>:</th>
                    <th>
                        {{-- <button class="btn btn-info">Download Jawaban</button> --}}
                        <a href="{{ route('downloadJawaban.download', App\Models\Ujian::where('pelamaran_id', $pelamaran->id)->get()[0]->id) }}" class="btn btn-info">Download Jawaban</a>
                    </th>
                </tr>
            </table>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Beri Nilai
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Submit File Soal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('ujian.nilai', App\Models\Ujian::where('pelamaran_id', $pelamaran->id)->get()[0]->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        {{-- <input type="hidden" name="pelamaran_id" value="{{ $pelamaran->id }}">
                        <input type="hidden" name="status" value="lolos tahap pelamaran">
                        <input type="file" name="file_soal" id="" class="form-control"> --}}
                        <input type="number" name="nilai" id="" class="form-control" max="100" required>
                        <button class="btn btn-primary mt-3">Submit Nilai</button>
                    </form>

                    <div class="form-group">
                        >= 70 = Berhasil
                        < 70 = Gagal
                    </div>
                    </div>
                </div>
                </div>
            </div>
            @elseif($pelamaran->status == "lolos tahap ujian" && Auth::user()->role == "hr")
            <form action="{{ route('interview.store') }}" method="post">
                @csrf
                <input type="hidden" name="status" value="pending interview">
                <input type="hidden" name="pelamaran_id" value="{{ $pelamaran->id }}">
                <div class="form-group">
                    <label for="">Invitation Title</label>
                    <input type="text" name="invitation_title" id="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Link Google Meet</label>
                    <input type="text" name="link_google_meet" id="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Date & Time</label>
                    <input type="datetime-local" name="waktu" id="" class="form-control" min="<?php echo date('Y-m-d\TH:i'); ?>" required>
                </div>
                <div class="form-group mt-2">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>
            {{-- <a href="" class="btn btn-danger">Tetapkan Sebagai Gagal Tahap Ujian</a> --}}
            @elseif($pelamaran->status == "pending interview" && Auth::user()->role == "tm")
            <a href="{{ App\Models\Interview::where('pelamaran_id', $pelamaran->id)->get()[0]->link_google_meet }}" class="btn btn-primary">Link Meeting - Jadwal : {{ App\Models\Interview::where('pelamaran_id', $pelamaran->id)->get()[0]->waktu }}</a>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Beri Nilai
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Submit Nilai Interview</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('interview.nilai', App\Models\Interview::where('pelamaran_id', $pelamaran->id)->get()[0]->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        {{-- <input type="hidden" name="pelamaran_id" value="{{ $pelamaran->id }}">
                        <input type="hidden" name="status" value="lolos tahap pelamaran">
                        <input type="file" name="file_soal" id="" class="form-control"> --}}
                        <input type="number" name="nilai" id="" class="form-control" max="100" required>
                        <button class="btn btn-primary mt-3">Submit Nilai</button>
                    </form>

                    <div class="form-group">
                        >= 70 = Berhasil
                        < 70 = Gagal
                    </div>
                    </div>
                </div>
                </div>
            </div>
            @endif
            {{-- <a href="" class="btn btn-success">Tetapkan Sebagai Lolos Tahap Pelamaran</a> --}}
            <!-- Button trigger modal -->

            
    </div>
@endsection
