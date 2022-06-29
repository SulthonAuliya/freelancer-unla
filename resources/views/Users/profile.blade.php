@extends('layouts.main')
@section('container')
<div class="card">
    <div class="container-fluid">
        <div class="row justify-content-center py-5">
            <div class="col-12 justify-content-center">
                @if ($user->profpic != null)
                    <img src="{{ asset('storage/'. $user->profpic) }}" class="rounded mx-auto d-block" alt="..." width="250px" height="200px">
                @else
                    <img src="https://d5nunyagcicgy.cloudfront.net/external_assets/hero_examples/hair_beach_v391182663/original.jpeg" class="rounded mx-auto d-block" alt="..." width="250px" height="200px">
                @endif
            </div>
            <div class="col-12 text-center mt-3">
                
                <h2>{{ $user->name }}</h2>
                @if($user->level === 1)
                    <p>Freelancer</p>
                @elseif($user->level === 2)
                    <p>Job Provider</p>
                @endif
                <p>{{ $user->alamat }}</p>
            </div>


        </div>
        <div class="row">
           <div class="col-12 mb-4">
            @auth
                @if ($user->id === auth()->user()->id)
                <a href="/profile/{{ $user->slug }}/edit" class="btn btn-primary"><b>Edit profile</b></a> 
                @endif
            @endauth
           </div>
            <div class="col-12">
                <h3><b>Description</b></h3>
            </div>
            <div class="col-12 mb-4">
                {!! $user->description !!}
            </div>
            <div class="col-12 ">
                <h3>
                    <b>Contact 
                        @auth
                            @if ($user->id === auth()->user()->id)
                            <a href="/contact/create" class="btn btn-primary"><b>+</b></a> 
                            @endif
                        @endauth
                    </b>
                </h3>
            </div>
            @foreach ($sosmed as $smd )
            <div class="col-12 mb-4">
                {{ $smd->sosmed_name }} : 
                    @if ($smd->link !== null)
                        <a href="{{ $smd->link }}" target="_blank">{{ $smd->username }}</a>
                    @else
                        {{ $smd->username }}
                    @endif
                @auth
                
                    @if ($user->id === auth()->user()->id)
                        <a href="/contact/{{ $smd->id }}/edit" class="btn btn-warning"><b>Edit</b></a>
                        <form action="/contact/{{ $smd->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')"> Delete</button>
                        </form>
                    @endif
                
                @endauth
            </div>
            @endforeach


            <div class="col-12 ">
                <h3>
                    <b>Lampiran 
                        @auth
                            @if ($user->id === auth()->user()->id)
                            <a href="/lampiran/create" class="btn btn-primary"><b>+</b></a> 
                            @endif
                        @endauth
                    </b>
                </h3>
            </div>
            @foreach ($lampirans as $lmp )
            <div class="col-3 mb-4 text-center">
                {{ $lmp->nama_lampiran }} <br>
                  
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{ $loop->iteration }}">
                    <img src="{{ asset('storage/'. $lmp->lampiran) }}" alt="" height="200">
                </a>    
                <div class="modal fade" id="exampleModalCenter{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle ">{{ $lmp->nama_lampiran }}</h5>
                        </div>
                        <div class="modal-body">
                            <img class="img-fluid" src="{{ asset('storage/'. $lmp->lampiran) }}" alt="" >
                        </div>
                        </div>
                    </div>
                </div>
                    <br><br>
                @auth
                    @if ($user->id === auth()->user()->id)
                        <a href="/lampiran/{{ $lmp->id }}/edit" class="btn btn-warning"><b>Edit</b></a>
                        <form action="/lampiran/{{ $lmp->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')"> Delete</button>
                        </form>
                    @endif
                 @endauth
                
            </div>
            @endforeach


            @if ($user->level === 2)
                
            <div class="col-12 mt-5">
                <h3><b>Available Jobs</b></h3>
            </div>
            <div class="col-12 ">
                @if ($jobs->count() > 0)
                <div class="container mt-5">
                    <div class="row">
                        @foreach ($jobs as $job )
                        <div class="col-md-4 mb-3 mx-auto-sm">
                            <div class="card" style="min-height: 38vh; box-shadow: 2px 2px 5px grey">
        
                                <div class="card-body d-flex flex-column">
                                  <h5 class="card-title fw-bold">{{ Str::limit(strip_tags($job->title), 60, '...')  }}</h5>
                                  <p>By. <a href="/profile" class="text-decoration-none">{{ $job->user->name }}</a><small class="text-muted"> {{ $job->created_at->diffForHumans() }}</small></p>
                                  <p>Category : <a href="/jobs?category={{ $job->category->slug }}" class=" text-decoration-none">{{ $job->category->nama_category }}</a></p>
                                  <a href="/jobs/{{ $job->slug }}" class="text-decoration-none btn btn-primary mt-auto">Read More</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <p class="text-center fs-4">No Jobs Available!</p>
                @endif
            </div>

            @endif

        </div>
    </div>
</div>

@endsection