<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Http\Request;


class SosmedController extends Controller
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
        return view('contact.add_contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSosmedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sosmed_name'      => 'required',
            'username'          => 'required',
        ]);


        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['link'] = $request->link;

        Sosmed::create($validatedData);

        return redirect('/profile/'.auth()->user()->slug)->with('success', "New Contact has been added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sosmed  $sosmed
     * @return \Illuminate\Http\Response
     */
    public function show(Sosmed $sosmed)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sosmed  $sosmed
     * @return \Illuminate\Http\Response
     */
    // dont forget to change the parameter variable name same into the one that is listed in route:list
    public function edit(Sosmed $contact)
    {
        return view('contact.edit',[
            'sosmed' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSosmedRequest  $request
     * @param  \App\Models\Sosmed  $sosmed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sosmed $contact)
    {
        $rules = [
            'sosmed_name'    => 'required',
            'username'       => 'required',
        ];
        

        $validatedData = $request->validate($rules);
        $validatedData['link'] = $request->link;
        if ($request->link === ''){
            $validatedData['link'] = '';
        }


        Sosmed::where('id', $contact->id)
            ->where('user_id', auth()->user()->id)
            ->update($validatedData);

        return redirect('/profile/'.auth()->user()->slug)->with('success', "Contact has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sosmed  $sosmed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sosmed $contact)
    {
        Sosmed::destroy($contact->id);

        return redirect('/profile/'.auth()->user()->slug)->with('success', "Contact has been deleted");
    }
}
