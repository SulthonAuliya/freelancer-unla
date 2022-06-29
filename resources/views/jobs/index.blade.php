@extends('layouts.main')
@section('container')
<div class="row justify-content-center">
   
    <div class="col-12">
        @if (request()->get('category'))
            <h3 class="text-center mx-auto text-fluid" style="width: 500px; font-weight: bolder">Category : {{ request()->get('category') }}</h3>
        @elseif (request()->get('search'))
            <h3 class="text-center mx-auto" style="width: 500px; font-weight: bolder">Results for : {{ request()->get('search') }}</h3>
        @else
            <h1 class="text-center mx-auto text-fluid" style="width: 500px; font-weight: bolder">Look for the newest jobs around you!</h1>
        @endif
    </div>
    <div class="col-8">
        <form action="/jobs">
            <div class="input-group mb-3 ">
                <input type="text" class="form-control" placeholder="Search job title or category" name="search" value="{{ request('search') }}">
                <button class="btn btn-primary text-light" type="submit">Search</button>
            </div>
        </form>
</div>
</div> 
    
    

    @if ($jobs->count() > 0)
        <div class="container mt-5">
            <div class="row">
                @foreach ($jobs as $job )
                <div class="col-md-4 mb-3 mx-auto-sm">
                    <div class="card" style="min-height: 38vh; box-shadow: 2px 2px 5px grey">

                        <div class="card-body d-flex flex-column">
                          <h5 class="card-title fw-bold">{{ Str::limit(strip_tags($job->title), 60, '...')  }}</h5>
                          <p>By. <a href="/profile/{{ $job->user->slug }}" class="text-decoration-none">{{ $job->user->name }}</a><small class="text-muted"> {{ $job->created_at->diffForHumans() }}</small></p>
                          <p>Category : <a href="/jobs?category={{ $job->category->slug }}" class=" text-decoration-none">{{ $job->category->nama_category }}</a></p>
                          <a href="/jobs/{{ $job->slug }}" class="text-decoration-none btn btn-primary mt-auto">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @else
    <p class="text-center fs-4">Post Not Found!</p>
    @endif
    <div class="d-flex justify-content-end">
        {{ $jobs->links('pagination::bootstrap-4') }}
    </div>
@endsection