@extends('layouts.carreer')

@section('title')
    Job Offer
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('mazer/assets/extensions/filepond/filepond.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/extensions/toastify-js/src/toastify.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/css/pages/filepond.css') }}">
@endpush
@section('content')
<div class="container-fluid" style="margin-bottom: 50px">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('kandidatoffer.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Posisi</th>
                    <th>:</th>
                    <td>{{ $job->posisi }}</td>
                </tr>
                <tr>
                    <th>Min. GPA</th>
                    <th>:</th>
                    <td>{{ $job->gpa }}</td>
                </tr>
                <tr>
                    <th>Min. Semester</th>
                    <th>:</th>
                    <td>{{ $job->semester }}</td>
                </tr>
                <tr>
                    <th>Min. Pengalaman Kerja</th>
                    <th>:</th>
                    <td>{{ $job->pengalaman_kerja }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <th>:</th>
                    <td>{{ $job->deskripsi }}</td>
                </tr>
                <tr>
                    <th>Responsible</th>
                    <th>:</th>
                    <td>{{ $job->responsible }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <th>:</th>
                    <td>
                        <span class="badge text-uppercase text-bg-{{ $job->status == "close" ? "danger" : "success" }}">{{ $job->status }}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    @if (Auth::user()->role != "pelamar")
        <div class="card">
            <div class="card-header">
                Pelamar
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>GPA</th>
                            <th>Semester</th>
                            <th>Pengalaman Kerja</th>
                            <th>Institusi/Universitas</th>
                            <th>CV</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $item)
                           <tr>
                                <th>{{$item->user->name}}</th>
                                <td>
                                    {{$item->gpa}} - <span class="text-uppercase"> {{$item->status_gpa }}</span>
                                </td>
                                <td>
                                    <div class="text-uppercase">{{ $item->isFreshGraduate == 1 ? "Fresh Graduate" : $item->semester . " - " . $item->status_semester}}</div>
                                </td>
                                <td>
                                    {{$item->pengalaman_kerja}} - <span class="text-uppercase"> {{$item->status_pengalaman_kerja }}</span>
                                </td>
                                <td>
                                    {{$item->institution}}
                                </td>
                                <td class="text-uppercase">
                                    {{-- <button class="btn btn-info">Download CV</button> --}}
                                    {{$item->status}}
                                </td>
                                <td>
                                    <a href="{{ route('pelamaran.show', $item->id) }}" class="btn btn-warning">Detail Lamaran</a>
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
    <div class="card mt-2">
        <div class="card-header">
            @if (count(App\Models\Pelamaran::where('user_id', Auth::user()->id)->where('offer_id', $job->id)->get()) > 0)
            Status Lamaranmu
            @else
            Ajukan Lamaranmu
            @endif
        </div>
        <div class="card-body">
            @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            {{-- {{App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['status']}} --}}
            @if (count(App\Models\Pelamaran::where('user_id', Auth::user()->id)->where('offer_id', $job->id)->get()) > 0)
                @if (App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['status'] == "pelamaran diajukan")
                <div class="alert alert-success fade show" role="alert">
                    Pelamaranmu telah diajukan, tunggu informasi berikutnya!!
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                  </div>
                  <table class="table">
                    <tr>
                        <th>Status</th>
                        <th>:</th>
                        <td>
                            <span class="badge text-uppercase text-bg-success">{{ App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['status'] }}</span>
                        </td>
                    </tr>
                </table>
                @elseif(App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['status'] == "lolos tahap pelamaran")
                {{-- {{App\Models\Ujian::where('pelamaran_id', App\Models\Pelamaran::where('user_id', Auth::user()->id)}} --}}
                {{-- {{App\Models\Ujian::where('pelamaran_id', App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['id'])->first()["batas_pengerjaan"] > date('Y-m-d') ? 'true' : 'false'}} --}}
                {{-- {{date('Y-m-d')}} --}}
                @if (date('Y-m-d') > App\Models\Ujian::where('pelamaran_id', App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['id'])->first()["batas_pengerjaan"])
                <div class="alert alert-danger fade show" role="alert">
                    Maaf kamu sudah tidak bisa lagi mengikuti ujian, karena sudah melebihi tanggal batas pengerjaan
                    {{-- Segera Upload File Jawabanmu s/d {{App\Models\Ujian::where('pelamaran_id', App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['id'])->first()["batas_pengerjaan"]}} --}}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                  </div>
                @else
                <div class="alert alert-success fade show" role="alert">
                    Segera Upload File Jawabanmu s/d {{App\Models\Ujian::where('pelamaran_id', App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['id'])->first()["batas_pengerjaan"]}}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                  </div>
                  <table class="table">
                    <tr>
                        <th>
                            Download Soal
                        </th>
                        <th>:</th>
                        <th>
                            {{-- <button class="btn btn-info">Download Soal</button> --}}
                            <a href="{{ route('downloadSoal.download', App\Models\Ujian::where('pelamaran_id', App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['id'])->get()[0]->id) }}" class="btn btn-info">Download Soal</a>
                        </th>
                    </tr>
                  </table>
                  @endif
                  @if (date('Y-m-d') > App\Models\Ujian::where('pelamaran_id', App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['id'])->first()["batas_pengerjaan"])
                    <div></div>
                  @else
                  <form action="{{ route('ujian.update', App\Models\Ujian::where("pelamaran_id", App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->get()[0]->id)->get()[0]->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="status" value="telah upload jawaban">
                    <div class="form-group">
                        <label for="">File Jawaban</label>
                    <input type="file" name="file_jawaban" id="" class="form-control" accept=".pdf" required>
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-primary">Submit Jawaban</button>
                    </div>
                  </form>
                  @endif
                  
                  @elseif (App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->get()[0]->status == "telah upload jawaban")
                  <div class="alert alert-success fade show" role="alert">
                      Jawabanmu telah disubmit, tunggu informasi berikutnya!!
                      {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                    </div>
                    <table class="table">
                      <tr>
                          <th>Status</th>
                          <th>:</th>
                          <td>
                              <span class="badge text-uppercase text-bg-success">{{ App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['status'] }}</span>
                          </td>
                      </tr>
                  </table>
                  @elseif (App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['status'] == "lolos tahap ujian")
                  <div class="alert alert-success fade show" role="alert">
                      Selamat Kamu Lolos tahap ujian, tunggu informasi berikutnya ya!!!
                      {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                    </div>
                    <table class="table">
                        <tr>
                            <th>
                                Nilai Ujian
                            </th>
                            <th>:</th>
                            <th>
                                <!-- Button trigger modal -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Lihat Nilai
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nilai Kamu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{App\Models\Ujian::where('pelamaran_id', App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['id'])->get()[0]->nilai}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
                            </th>
                        </tr>
                    </table>
                    @elseif (App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['status'] == "gagal tahap pelamaran")
                  <div class="alert alert-danger fade show" role="alert">
                      Maaf kamu tidak lolos tahap pelamaran, tetap semangat ya!!!
                      {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                    </div>
                    @elseif (App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['status'] == "gagal tahap ujian")
                  <div class="alert alert-danger fade show" role="alert">
                      Maaf kamu tidak lolos tahap ujian, tetap semangat ya!!!
                      {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                    </div>
                    @elseif (App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['status'] == "tidak diterima interview")
                  <div class="alert alert-danger fade show" role="alert">
                      Maaf kamu tidak lolos tahap interview, tetap semangat ya!!!
                      {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                    </div>
                    @elseif (App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['status'] == "pending interview")
                    <div class="alert alert-success fade show" role="alert">
                        Selamat Kamu Masuk tahap interview!!! - Jadwal Interview : {{ App\Models\Interview::where('pelamaran_id', App\Models\Pelamaran::where('user_id', Auth::user()->id)->where('offer_id', $job->id)->get()[0]->id)->get()[0]->waktu }}
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                      </div>
                      <a href="{{ App\Models\Interview::where('pelamaran_id', App\Models\Pelamaran::where('user_id', Auth::user()->id)->where('offer_id', $job->id)->get()[0]->id)->get()[0]->link_google_meet }}" class="btn btn-success">Link Meeting</a>
                    @elseif(App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['status'] == "diterima")
                    <div class="alert alert-success fade show" role="alert">
                        Selamat Kamu diterima di pekerjaan ini!!
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                      </div>
                      <table class="table">
                        <tr>
                            <th>
                                Nilai Ujian
                            </th>
                            <th>:</th>
                            <th>
                                <!-- Button trigger modal -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Lihat Nilai
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nilai Kamu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{App\Models\Ujian::where('pelamaran_id', App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['id'])->get()[0]->nilai}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Nilai Interview
                            </th>
                            <th>:</th>
                            <th>
                                <!-- Button trigger modal -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#interviewModal">
    Lihat Nilai
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="interviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nilai Kamu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{App\Models\Interview::where('pelamaran_id', App\Models\Pelamaran::where('user_id', Auth::user()->id)->where("offer_id", $job->id)->first()['id'])->get()[0]->nilai}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
                            </th>
                        </tr>
                    </table>
                @endif
            @else
            <form action="{{ route('pelamaran.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="status" value="pelamaran diajukan">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="offer_id" value="{{ $job->id }}">
                <div class="form-group">
                    <label for="">Apakah Kamu seorang Fresh Graduate?</label>
                    <input type="radio" name="isFreshGraduate" value="true" id="ya">Ya
                    <input type="radio" name="isFreshGraduate" value="false" id="tidak">Tidak
                </div>
                {{-- <div id="klasifikasi"> --}}
                <div class="form-group">
                    <label for="">GPA</label>
                    <input type="number" name="gpa" class="form-control mt-2" step=".01">
                </div>
                <div class="form-group" id="klasifikasi">
                    <label for="">Semester</label>
                    <input type="number" name="semester" class="form-control mt-2">
                </div>
                <div class="form-group">
                    <label for="">Pengalaman Kerja</label>
                    <input type="number" name="pengalaman_kerja" class="form-control mt-2">
                </div>
                {{-- </div> --}}
                <div class="form-group">
                    <label for="">Motivation Letter</label>
                    {{-- <input type="number" name="gpa" class="form-control mt-2"> --}}
                    <textarea name="deskripsi_pelamar" id="" cols="30" rows="10" class="form-control mt-2" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Institution/University</label>
                    <input type="text" name="institution" class="form-control mt-2" required>
                </div>
                <div class="form-group">
                    <label for="">CV/Portfolio</label>
                    <input type="file" class="form-control mt-2" name="cv" required>
                    {{-- <input type="number" name="gpa" class="form-control mt-2"> --}}
                </div>
                <div class="form-group">
                    <button class="btn btn-primary mt-2">Submit</button>
                </div>
            </form>
            
            @endif
        </div>
    </div>
    @endif
</div>

@endsection
@push('scripts')
{{-- <script src="{{ asset('mazer/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('mazer/assets/js/pages/datatables.js') }}"></script> --}}

<script src="{{ asset('mazer/assets/extensions/filepond/filepond.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/toastify-js/src/toastify.js') }}"></script>
<script src="{{ asset('mazer/assets/js/pages/filepond.js') }}"></script>
<script>
    let ya = document.getElementById('ya')
    let tidak = document.getElementById('tidak')
    let klasifikasi = document.getElementById('klasifikasi')

    klasifikasi.classList.add('d-none')

    ya.addEventListener('click', () => {
        klasifikasi.classList.add('d-none')
    })

    tidak.addEventListener('click', () => {
        klasifikasi.classList.remove('d-none')
    })
</script>
@endpush