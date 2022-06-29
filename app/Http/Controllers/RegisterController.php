<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Cviebrock\EloquentSluggable\Services\SlugService;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index');
    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
            'level'     => 'required'
        ]);
        $slug = SlugService::createSlug(User::class, 'slug', $request->name, ['unique' =>true]);
        $validatedData['slug'] = $slug;

        // $validatedData['password'] = bcrypt($validatedData['password']);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // $request->session()->flash('success', 'Registration success! Please login');


        return redirect('/login')->with('success', 'Registration success! Please login');
    }
}
