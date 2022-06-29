@extends('layouts.main')
@section('container')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-9">
            <div class="card pt-5 pb-5">
                <div class="container-fluid">

                    <div class="col-12">
                        @can('freelancer')
                            <a href="/lamar" class="btn btn-success"> Back to My Lamaran</a>
                        @endcan
                        @can('provider')
                        <a href="/lamarans" class="btn btn-success"> Back to Lamaran Masuk</a>
                        @endcan
                        

                        <form action="/jobs/{{ $lamaran->job->slug }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')"> Delete</button>
                        </form>
                    </div>

                {{-- {{ dd($lamaran) }} --}}
                    <h2 class="mb-3 fw-bold mt-3">{{ $lamaran->job->title }}</h2>

    
                    <p>By. <a href="/jobs?user={{ $lamaran->job->user->name }}" class="text-decoration-none">{{ $lamaran->job->user->name }}</a> in <a href="/jobs?category={{ $lamaran->job->category->slug }}" class="text-decoration-none">{{ $lamaran->job->category->nama_category }}</a></p>
    
                    <article class="my-3 fs-5">
                        {!! $lamaran->job->description !!}
                    </article>
                    
                    <h5>Expected Salary Rp. <b>{{ number_format($lamaran->job->expected_salary,2,',','.'); }}</b></h5>

                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection