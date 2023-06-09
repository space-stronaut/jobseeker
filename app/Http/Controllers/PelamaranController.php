<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JobOffer;
use App\Models\Notification;
use App\Models\Pelamaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $data['status_gpa'] = $request->gpa >= $job->gpa ? "verified" : "unverified";
        $data['status_semester'] = $request->semester >= $job->semester ? "verified" : "unverified";
        $data['status_pengalaman_kerja'] = $request->pengalaman_kerja >= $job->pengalaman_kerja ? "verified" : "unverified";
        // $data['deskripsi_pelamar'] = $request->deskripsi;

        Pelamaran::create($data);

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'sender' => Auth::user()->id,
                'recipient' => $admin->id,
                'message' => "Pelamar Baru untuk Posisi : " . $job->posisi . " (". Auth::user()->name . ")",
                'type' => 'info'
            ]);
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

        Notification::create([
            'sender' => Auth::user()->id,
            'recipient' => Pelamaran::find($id)->user_id,
            'message' => "Status lamaranmu untuk posisi ". Pelamaran::find($id)->offer->posisi . " : " . $request->status,
            'type' => 'info'
        ]);

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
}
