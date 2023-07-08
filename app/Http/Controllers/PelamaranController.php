<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\PelamarBaruMail;
use App\Mail\StatusMail;
use App\Models\JobOffer;
use App\Models\Notification;
use App\Models\Pelamaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class PelamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelamarans = Pelamaran::where('user_id', Auth::user()->id)->get();

        return view('pelamaran.index', compact('pelamarans'));
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
        $data = $request->all();

        $data['cv'] = $request->file('cv')->store(
            'cv', 'public'
        );
        

        $job = JobOffer::find($request->offer_id);
        if ($request->isFreshGraduate == "true") {
            $data['isFreshGraduate'] = true;
        }else{
            $data['isFreshGraduate'] = false;
            // $data['status_gpa'] = $request->gpa >= $job->gpa ? "verified" : "unverified";
        // $data['status_semester'] = $request->semester >= $job->semester ? "verified" : "unverified";
        // $data['status_pengalaman_kerja'] = $request->pengalaman_kerja >= $job->pengalaman_kerja ? "verified" : "unverified";
        }

        $data['status_gpa'] = $request->gpa >= $job->gpa ? "verified" : "unverified";
        // $data['status_semester'] = $request->semester >= $job->semester ? "verified" : "unverified";
        $data['status_pengalaman_kerja'] = $request->pengalaman_kerja >= $job->pengalaman_kerja ? "verified" : "unverified";
        // $data['deskripsi_pelamar'] = $request->deskripsi;

        $pelamaran = Pelamaran::create($data);

        $admins = User::where('role', '!=' ,'pelamar')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'sender' => Auth::user()->id,
                'recipient' => $admin->id,
                'message' => "Pelamar Baru untuk Posisi : " . $job->posisi . " (". Auth::user()->name . ")",
                'type' => 'info'
            ]);

            Mail::to($admin->email)->send(new PelamarBaruMail("Pelamar Baru Untuk Posisi : ". $job->posisi, $pelamaran->id));
        }

        return redirect()->back()->with('success', "Pelamaran Berhasil Diajukan!!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelamaran = Pelamaran::find($id);

        return view('pelamaran.show', compact('pelamaran'));
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
        Pelamaran::find($id)->update([
            'status' => $request->status
        ]);

        $user = User::find(Pelamaran::find($id)->user_id);

        Notification::create([
            'sender' => Auth::user()->id,
            'recipient' => Pelamaran::find($id)->user_id,
            'message' => "Status lamaranmu untuk posisi ". Pelamaran::find($id)->offer->posisi . " : " . $request->status,
            'type' => 'info'
        ]);

        $job = JobOffer::find(Pelamaran::find($id)->offer_id);

        Mail::to($user->email)->send(new StatusMail("Status Lamaran : ". $job->posisi, Pelamaran::find($id), $job));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function download(string $id)
    {
        $pelamaran = Pelamaran::findOrFail($id);
        $filePath = storage_path('app/public/' . $pelamaran->cv);
        
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
    public function cetak(Request $request)
    {
        $pelamarans = Pelamaran::select("*")
    ->where(DB::raw('date(created_at)'), '>=' , $request->start)
    ->where(DB::raw('date(created_at)'), '<=' , $request->end)
    ->where('status', $request->type)
    ->get();
        $date = date("Ymd");
 
        $pdf = PDF::loadview('pdf.index',['pelamarans'=>$pelamarans, 'type' => $request->type, 'start' => $request->start, 'end' => $request->end]);
        return $pdf->download('laporan-pelamaran'. $date .'.pdf');

        // dd($pelamarans);
    }
}
