@extends('layouts.main')
@section('container')
<div class="card col-9 mx-auto ">
<div class="container-fluid">

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Job</h1>
</div>


<div class="col-lg-12">
    <form method="POST" action="/jobs" class="mb-5" >
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" name="title" required autofocus>
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>                
            @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select  @error('category') is-invalid @enderror" name="category_id">
                @foreach ($categories as $category )
                    @if (old('category_id') == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->nama_category }}</option>
                    @else
                        <option value="{{ $category->id }}" >{{ $category->nama_category }}</option>
                    @endif 
                    
                @endforeach
            </select>
            @error('category')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>                
            @enderror
        </div>

        <div class="mb-3">
            <label for="expected_salary" class="form-label">Expected Salary</label>
            <input type="number" class="form-control @error('expected_salary') is-invalid @enderror" value="{{ old('salary') }}" id="salary" name="expected_salary" required autofocus>
            @error('expected_salary')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>                
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input id="description" type="hidden" name="description" value="{{ old('description') }}">
            <trix-editor input="description" class="@error('description') is-invalid @enderror"></trix-editor>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>                
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Post!</button>
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