<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\StatusMail;
use App\Models\JobOffer;
use App\Models\Notification;
use App\Models\Pelamaran;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pelamaran::find($request->pelamaran_id)->update([
            'status' => $request->status
        ]);

        $data = $request->file('file_soal')->store(
            'file_soal', 'public'
        );

        Ujian::create([
            'pelamaran_id' => $request->pelamaran_id,
            'file_soal' => $data,
            'batas_pengerjaan' => $request->batas_pengerjaan
        ]);

        $user = User::find(Pelamaran::find($request->pelamaran_id)->user_id);
        $job = JobOffer::find(Pelamaran::find($request->pelamaran_id)->offer_id);

        Notification::create([
            'sender' => Auth::user()->id,
            'recipient' => Pelamaran::find($request->pelamaran_id)->user_id,
            'message' => "Soal ujian mu untuk posisi ". Pelamaran::find($request->pelamaran_id)->offer->posisi . " telah tersedia",
            'type' => 'info'
        ]);

        // Mail::to($user->email)->send(new StatusMail("Selamat Kamu Lolos tahap screening CV untuk posisi : " . $job->posisi . "\n Kamu sekarang ada di tahap Ujian" , Pelamaran::find($request->pelamaran_id), $job));

        return redirect()->back();

    }

    public function batas(Request $request, string $id)
    {
        Ujian::find($id)->update([
            'batas_pengerjaan' => $request->batas_pengerjaan
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ujian = Ujian::find($id);

        Pelamaran::find($ujian->pelamaran_id)->update([
            'status' => $request->status
        ]);

        $data = $request->file('file_jawaban')->store(
            'file_jawaban', 'public'
        );

        Ujian::find($id)->update([
            // 'pelamaran_id' => $request->pelamaran_id,
            'file_jawaban' => $data
        ]);

        $admins = User::where('role', '!=' ,'pelamar')->get();
        $job = JobOffer::find(Pelamaran::find(Ujian::find($id)->pelamaran_id)->offer_id);

        foreach ($admins as $admin) {
            Notification::create([
                'sender' => Auth::user()->id,
                'recipient' => $admin->id,
                'message' => "Jawaban Soal dari User ". Pelamaran::find($ujian->pelamaran_id)->user->name . " untuk posisi ". Pelamaran::find($ujian->pelamaran_id)->offer->posisi ." telah tersedia" ,
                'type' => 'info'
            ]);

            // Mail::to($admin->email)->send(new StatusMail("Jawaban Soal dari User ". Pelamaran::find($ujian->pelamaran_id)->user->name . " untuk posisi ". Pelamaran::find($ujian->pelamaran_id)->offer->posisi ." telah tersedia" , Pelamaran::find($ujian->pelamaran_id), $job));
        }

        return redirect()->back()->with('success', 'Berhasil Upload Jawaban');
    }

    public function nilai(Request $request, string $id)
    {
        // $ujian = Ujian::find($id);

        Ujian::find($id)->update([
            'nilai' => $request->nilai
        ]);

        Pelamaran::find(Ujian::find($id)->pelamaran_id)->update([
            'status' => $request->nilai >= 70 ? "lolos tahap ujian" : "gagal tahap ujian"
        ]);

        $user = User::find(Pelamaran::find(Ujian::find($id)->pelamaran_id)->user_id);
        $job = JobOffer::find(Pelamaran::find(Ujian::find($id)->pelamaran_id)->offer_id);

        Notification::create([
            'sender' => Auth::user()->id,
            'recipient' => Pelamaran::find(Ujian::find($id)->pelamaran_id)->user_id,
            'message' => "Nilai ujian mu untuk posisi ". Pelamaran::find(Ujian::find($id)->pelamaran_id)->offer->posisi . " telah tersedia",
            'type' => 'info'
        ]);

        // Mail::to($user->email)->send(new StatusMail("Nilai ujian mu untuk posisi ". Pelamaran::find(Ujian::find($id)->pelamaran_id)->offer->posisi . " telah tersedia" , Pelamaran::find(Ujian::find($id)->pelamaran_id), $job));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function downloadSoal(string $id)
    {
        $ujian = Ujian::findOrFail($id);
        $filePath = storage_path('app/public/' . $ujian->file_soal);
        
        if (file_exists($filePath)) {
            // return response()->download($filePath, $pelamaran->cv);
            // dd('ada');
            $filename = pathinfo($filePath, PATHINFO_FILENAME);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $downloadFilename = $filename . '.' . $extension;

        return response()->download($filePath, $downloadFilename);
        } else {
            abort(404, 'File not found');
    }
    }

    public function downloadJawaban(string $id)
    {
        $ujian = Ujian::findOrFail($id);
        $filePath = storage_path('app/public/' . $ujian->file_jawaban);
        
        if (file_exists($filePath)) {
            // return response()->download($filePath, $pelamaran->cv);
            // dd('ada');
            $filename = pathinfo($filePath, PATHINFO_FILENAME);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $downloadFilename = $filename . '.' . $extension;

        return response()->download($filePath, $downloadFilename);
        } else {
            abort(404, 'File not found');
    }
    }
}
