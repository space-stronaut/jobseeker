<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\StatusMail;
use App\Models\Interview;
use App\Models\JobOffer;
use App\Models\Notification;
use App\Models\Pelamaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InterviewController extends Controller
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

        $interview = Interview::create([
            'invitation_title' => $request->invitation_title,
            'pelamaran_id' => $request->pelamaran_id,
            'link_google_meet' => $request->link_google_meet,
            'waktu' => $request->waktu
        ]);

        Notification::create([
            'sender' => Auth::user()->id,
            'recipient' => Pelamaran::find($request->pelamaran_id)->user_id,
            'message' => "Jadwal interviewmu untuk posisi " . Pelamaran::find($request->pelamaran_id)->offer->posisi . " adalah : ".  $interview->waktu,
            'type' => 'info'
        ]);

        $tms = User::where('role', 'tm')->get();

        foreach ($tms as $tm) {
            Notification::create([
                'sender' => Auth::user()->id,
                'recipient' => $tm->id,
                'message' => "Jadwal interview dengan " .User::find(Pelamaran::find($interview->pelamaran_id)->user_id)->name . " posisi ". Pelamaran::find($interview->pelamaran_id)->offer->posisi . " telah keluar",
                'type' => 'info'
            ]);
        }

        $job = JobOffer::find(Pelamaran::find($request->pelamaran_id)->offer_id);

        // Mail::to(Pelamaran::find($request->pelamaran_id)->user->email)->send(new StatusMail("Jadwal interviewmu untuk posisi " . Pelamaran::find($request->pelamaran_id)->offer->posisi . " adalah : ".  $interview->waktu, Pelamaran::find($request->pelamaran_id), $job));

        

        return redirect()->back();
    }

    public function nilai(Request $request, string $id)
    {
        // $ujian = Ujian::find($id);

        Interview::find($id)->update([
            'nilai' => $request->nilai
        ]);

        Pelamaran::find(Interview::find($id)->pelamaran_id)->update([
            'status' => $request->nilai >= 70 ? "diterima" : "tidak diterima interview"
        ]);

        Notification::create([
            'sender' => Auth::user()->id,
            'recipient' => Pelamaran::find(Interview::find($id)->pelamaran_id)->user_id,
            'message' => $request->nilai > 70 ? "Selamat Kamu diterima di posisi " . Pelamaran::find(Interview::find($id)->pelamaran_id)->offer->posisi : "Maaf Kamu gagal diterima di posisi " . Pelamaran::find(Interview::find($id)->pelamaran_id)->offer->posisi,
            'type' => 'info'
        ]);

        $hrs = User::where('role', 'hr')->get();

        foreach ($hrs as $hr) {
            Notification::create([
                'sender' => Auth::user()->id,
                'recipient' => $hr->id,
                'message' => "Hasil Interview ". User::find(Pelamaran::find(Interview::find($id)->pelamaran_id)->user_id)->name . " untuk posisi ". Pelamaran::find(Interview::find($id)->pelamaran_id)->offer->posisi . " telah keluar",
                'type' => 'info'
            ]);
        }

        $job = JobOffer::find(Pelamaran::find(Interview::find($id)->pelamaran_id)->offer_id);

        // Mail::to(Pelamaran::find(Interview::find($id)->pelamaran_id)->user->email)->send(new StatusMail($request->nilai > 70 ? "Selamat Kamu diterima di posisi " . Pelamaran::find(Interview::find($id)->pelamaran_id)->offer->posisi : "Maaf Kamu gagal diterima di posisi " . Pelamaran::find(Interview::find($id)->pelamaran_id)->offer->posisi, Pelamaran::find(Interview::find($id)->pelamaran_id), $job));

        

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
