<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Lamaran;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lamaran = Lamaran::where('user_id', auth()->user()->id)->get();
        
        return view('lamaran.my_lamaran', [
            "lamaran"   => $lamaran
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_job'        => 'required',
            'title'         => 'required|max:255',
            'expected_salary'   => 'required'

        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['status_lamaran'] = 'pending';

        Lamaran::create($validatedData);

        return redirect('/lamar')->with('success', "You have applied to this job!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function show($lamaran)
    {
        $lamar = Lamaran::findOrFail($lamaran);
        return view('lamaran.show',[
            "lamaran" => $lamar
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Lamaran $lamaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lamaran $lamaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($lamaran)
    {
        Lamaran::destroy($lamaran);

        return redirect('/lamar')->with('success', "Lamaran has been deleted");
    }

    
}
