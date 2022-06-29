<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
        }
        if(request('user')){
            $user = User::firstWhere('username', request('user'));
        }

        return view('jobs.index',[
            'jobs'  => Job::latest()->where('status_job', 'ongoing')->filter(request(['search', 'category', 'author']))->paginate(9)->withQueryString()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create',[
            'categories' => Category::all()
        ]);
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
            'title'         => 'required|max:255',
            'category_id'   => 'required',
            'description'   => 'required',
            'expected_salary'   => 'required',
        ]);


        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['type'] = "freelance";
        $validatedData['status_job'] = "ongoing";
        $slug = SlugService::createSlug(Job::class, 'slug', $request->title, ['unique' =>true]);
        $validatedData['slug'] = $slug;

        Job::create($validatedData);

        return redirect('/jobs')->with('success', "New Post has been added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        
        return view('jobs.show',[
            "jobs" => $job
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', [
            'jobs' => $job,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $rules = [
            'title'             => 'required|max:255',
            'category_id'       => 'required',
            'description'       => 'required',
            'expected_salary'   => 'required',
            'status_job'        => 'required'
        ];
        

        $validatedData = $request->validate($rules);
        $slug = SlugService::createSlug(Job::class, 'slug', $request->title, ['unique' =>true]);
        $validatedData['slug'] = $job->slug;
        if($slug != $job->slug){
            $validatedData['slug'] = $slug;
        }



        Job::where('id', $job->id)
            ->where('user_id', auth()->user()->id)
            ->update($validatedData);

        return redirect('/jobs')->with('success', "Job has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        Job::destroy($job->id);

        return redirect('/jobs')->with('success', "Job has been deleted");
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Job::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }


    public function lamar(Job $job){
        $user = User::where('id', auth()->user()->id)->get();
        return view('lamaran.apply',[
            "jobs" => $job,
            "user" => $user
        ]);
    }

}
