<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JobOffer;
use App\Models\Notification;
use App\Models\Pelamaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = JobOffer::all();

        return view('job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $job = JobOffer::create($request->all());
        $users = User::where('role', 'pelamar')->get();
        foreach ( $users as $user) {
            Notification::create([
                'sender' => Auth::user()->id,
                'recipient' => $user->id,
                'message' => "Lamaran Tersedia : ".$job->posisi,
                'type' => 'info'
            ]);
        }

        return redirect()->route('job.index')->with('success', 'Job Offer Successfully Created!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = JobOffer::find($id);
        // $users = User::where('offer_id', $job->id)->get();
        $jobs = Pelamaran::where('offer_id', $id)->get();

        return view('job.show', compact('job', 'jobs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = JobOffer::find($id);

        return view('job.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        JobOffer::find($id)->update($request->all());

        return redirect()->route('job.index')->with('success', 'Job Offer Successfully Updated!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JobOffer::find($id)->delete();

        return redirect()->back()->with('success', 'Job Offer Successfully Deleted!!!');
    }
}
