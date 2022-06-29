@extends('layouts.main')
@section('container')

<div class="card col-9 mx-auto ">
    <div class="container-fluid">
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Contact</h1>
    </div>
    
    
    <div class="col-lg-12">
        <form method="POST" action="/contact/{{ $sosmed->id }}" class="mb-5" >
            @method('PUT')
             @csrf
            <div class="mb-3">
                <label for="sosmed_name" class="form-label">Apps Name</label>
                <input type="text" class="form-control @error('sosmed_name') is-invalid @enderror" value="{{ $sosmed->sosmed_name }}" id="sosmed_name" name="sosmed_name" required autofocus>
                @error('sosmed_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>                
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">User Name / Phone Number</label>
                <input type="text" class="form-control @error('user') is-invalid @enderror" value="{{ $sosmed->username }}" id="username" name="username" required autofocus>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>                
                @enderror
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">*optional Link</label>
                <input type="text" class="form-control @error('link') is-invalid @enderror" value="{{ $sosmed->link }}" id="link" name="link" autofocus>
            </div>
    

    
            <button type="submit" class="btn btn-primary">Edit Contact</button>
        </form>
    </div>
    </div>
    </div>

@endsection