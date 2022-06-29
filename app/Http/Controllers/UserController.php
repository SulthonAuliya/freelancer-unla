<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Sosmed;
use App\Models\User;
use App\Models\Lampiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class UserController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $profile)
    {

        $sosmed = Sosmed::where('user_id', $profile->id)->get();
        $users = User::where('slug', $profile->slug)->first();
        $post = Job::where('user_id', $profile->id)->where('status_job', 'ongoing')->get();
        $lampiran = Lampiran::where('user_id', $profile->id)->get();

        return view ('Users.profile', [
            'sosmed' => $sosmed,
            'user'  => $users,
            'jobs'  => $post,
            'lampirans' => $lampiran
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $profile)
    {
        $sosmed = Sosmed::where('user_id', $profile->id)->get();
        $users = User::where('slug', $profile->slug)->first();

        return view ('Users.edit', [
            'sosmed' => $sosmed,
            'user'  => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $profile)
    {
        $rules = [
            'name'          => 'required|max:255',
            'email'         => 'required',
            'no_hp'         => 'required',
            'level'         => 'required',
            'alamat'        => 'required',
            'description'   => 'required'
        ];
        

        $validatedData = $request->validate($rules);
        $slug = SlugService::createSlug(User::class, 'slug', $request->name, ['unique' =>true]);
        
        if($request->input('slug') != $profile->slug){
            $validatedData['slug'] = $slug;
        }else{
            $validatedData['slug'] = $profile->slug;
        }

        if($request->file('profpict')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['profpic'] = $request->file('profpict')->store('images');
        }



        User::where('id',auth()->user()->id)
            ->update($validatedData);

        $sosmed = Sosmed::where('user_id', $profile->id)->get();
        $users = User::where('slug', $profile->slug)->first();
        return redirect('/profile/'.$users->slug)->with([
            'success' => "Job has been updated!",
            'sosmed' => $sosmed,
            'user'  => $users
        ]);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
