@extends('layouts.main')
@section('container')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-9">
            <div class="card pt-5 pb-5">
                <div class="container-fluid">

                    <div class="col-12">
                        <a href="/" class="btn btn-success"> Back to Home</a>
                        @auth
                            @if ($jobs->user_id === auth()->user()->id)
                                <a href="/jobs/{{ $jobs->slug }}/edit" class="btn btn-warning"> Edit</a>
                                <form action="/jobs/{{ $jobs->slug }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"> Delete</button>
                                </form>
                            @endif
                        @endauth
                    </div>

                    <h2 class="mb-3 fw-bold mt-3">{{ $jobs->title }}</h2>
    
                    <p>By. <a href="/jobs?user={{ $jobs->user->name }}" class="text-decoration-none">{{ $jobs->user->name }}</a> in <a href="/jobs?category={{ $jobs->category->slug }}" class="text-decoration-none">{{ $jobs->category->nama_category }}</a></p>
    
                    <article class="my-3 fs-5">
                        {!! $jobs->description !!}
                    </article>
                    
                    <h5>Expected Salary Rp. <b>{{ number_format($jobs->expected_salary,2,',','.'); }}</b></h5>

                    @can('freelancer')
                        
                    <a href="/lamaran/{{ $jobs->slug }}" class="btn btn-primary mt-3 d-block fw-bold">Lamar!</a>
                    
                    @endcan
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection