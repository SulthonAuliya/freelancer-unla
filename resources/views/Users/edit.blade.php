@extends('layouts.main')
@section('container')
<div class="card col-9 mx-auto ">
<div class="container-fluid">

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Profile</h1>
</div>

<div class="col-lg-12">
    <form method="POST" action="/profile/{{ $user->slug }}" class="mb-5" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" id="name" name="name" required autofocus>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>                
            @enderror
        </div>

        <div class="mb-3">
            <input type="hidden" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $user->slug) }}" id="slug" name="slug" required autofocus>
            @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>                
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="mail" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" id="email" name="email" required autofocus>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>                
            @enderror
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">no_hp</label>
            <input type="Text" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $user->no_hp) }}" id="no_hp" name="no_hp" required autofocus>
            @error('no_hp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>                
            @enderror
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">alamat</label>
            <input type="Text" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat', $user->alamat) }}" id="alamat" name="alamat" required autofocus>
            @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>                
            @enderror
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">role</label>
            <select class="form-select  @error('level') is-invalid @enderror" name="level">
                <option value="1" {{ $user->level == '1' ? 'selected' : '' }}>Freelancer</option>
                <option value="2" {{ $user->level == '2' ? 'selected' : '' }}>Job Provider</option>

            </select>
            @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>                
            @enderror
        </div>

        <div class="mb-3">
            <label for="profpict" class="form-label">Profile Picture</label>
            <input type="hidden" name="oldImage" value="{{ $user->profpict }}">
            @if ($user->profpic)
                <img src="{{ asset('storage/' . $user->profpic) }}" alt="" class="img-fluid img-preview mb-3 col-sm-5 d-block">
            @else
                <img src="" alt="" class="img-fluid img-preview mb-3 col-sm-5">
            @endif
            
            <input class="form-control @error('profpict') is-invalid @enderror" type="file" name="profpict" id="profpict" onchange="previewImage()">
            @error('profpict')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>                
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input id="description" type="hidden" name="description" value="{{ old('description', $user->description) }}">
            <trix-editor input="description" class="@error('description') is-invalid @enderror"></trix-editor>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>                
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Edit Profile</button>
        <a href="/profile/{{ $user->slug }}" class="btn btn-success ">Back</a>
    </form>
</div>
</div>
</div>

<script>

    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault()
    });  
</script>

@endsection