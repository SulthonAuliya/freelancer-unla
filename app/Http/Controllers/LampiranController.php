<?php

namespace App\Http\Controllers;

use App\Models\Lampiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LampiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lampiran.create');
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
            'nama_lampiran'      => 'required'
        ]);


        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['lampiran'] = $request->file('lampiran')->store('images');
        

        Lampiran::create($validatedData);

        return redirect('/profile/'.auth()->user()->slug)->with('success', "New Lampiran has been added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lampiran  $lampiran
     * @return \Illuminate\Http\Response
     */
    public function show(Lampiran $lampiran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lampiran  $lampiran
     * @return \Illuminate\Http\Response
     */
    public function edit(Lampiran $lampiran)
    {
        return view('lampiran.edit', [
            'lampiran' => $lampiran
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lampiran  $lampiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lampiran $lampiran)
    {
        $validatedData = $request->validate([
            'nama_lampiran'      => 'required'
        ]);


        $validatedData['user_id'] = auth()->user()->id;
        if($request->file('lampiran')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['lampiran'] = $request->file('lampiran')->store('images');
        }
        $validatedData['lampiran'] = $request->file('lampiran')->store('images');
        

        Lampiran::where('id',$lampiran->id)
            ->update($validatedData);

        return redirect('/profile/'.auth()->user()->slug)->with('success', "Lampiran has been edited!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lampiran  $lampiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lampiran $lampiran)
    {

        Lampiran::destroy($lampiran->id);

        return redirect('/profile/'.auth()->user()->slug)->with('success', "Lampiran has been deleted");
    }
}
