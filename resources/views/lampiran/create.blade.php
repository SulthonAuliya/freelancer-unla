@extends('layouts.main')
@section('container')

<div class="card col-9 mx-auto ">
    <div class="container-fluid">
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Lampiran</h1>
    </div>
    
    
    <div class="col-lg-12">
        <form method="POST" action="/lampiran" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_lampiran" class="form-label">Nama Lampiran</label>
                <input type="text" class="form-control @error('nama_lampiran') is-invalid @enderror" value="{{ old('nama_lampiran') }}" id="nama_lampiran" name="nama_lampiran" required autofocus>
                @error('nama_lampiran')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>                
                @enderror
            </div>
            <div class="mb-3">
                <label for="lampiran" class="form-label">Lampiran *image file type only</label>                
                <input class="form-control @error('lampiran') is-invalid @enderror" type="file" name="lampiran" id="lampiran" onchange="previewImage()">
                @error('lampiran')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>                
                @enderror
            </div>
    

    
            <button type="submit" class="btn btn-primary">Add Lampiran</button>
        </form>
    </div>
    </div>
    </div>

@endsection