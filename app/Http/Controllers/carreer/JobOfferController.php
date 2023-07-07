<?php

namespace App\Http\Controllers\carreer;

use App\Http\Controllers\Controller;
use App\Models\JobOffer;
use App\Models\Pelamaran;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = JobOffer::all();

        return view('kandidat.offer.index', compact('jobs'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = JobOffer::find($id);
        // $users = User::where('offer_id', $job->id)->get();
        $jobs = Pelamaran::where('offer_id', $id)->get();

        return view('kandidat.offer.show', compact('job', 'jobs'));
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
