@extends('layouts.main')
@section('container')
    <div class="card mx-auto col-9 p-4">
        <div class="container-fluid">
            <div class="text-center">
                <h1>Is this application information right?</h1>
            </div>
            <div class="col-lg-12 mt-3">
                <form method="POST" action="/lamar" class="mb-5" >
                    @csrf
                    <input type="hidden" name="id_job" value="{{ $jobs->id }}">
                    <div class="mb-1">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control-plaintext" value="{{ old('title', $jobs->title) }}" id="title" name="title" readonly required>
                    </div>
                    </div>
            
                    <div class="mb-3">
                        <label for="expected_salary" class="form-label">Expected Salary</label>
                        <input type="number" class="form-control-plaintext @error('expected_salary') is-invalid @enderror" value="{{ old('salary', $jobs->expected_salary) }}" id="salary" name="expected_salary" required autofocus>
                        @error('expected_salary')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>                
                        @enderror
                    </div>

                    <a href="/jobs/{{ $jobs->slug }}" class="btn btn-success ">Back</a>
                    <button type="submit" class="btn btn-primary">Apply!</button>
                </form>
            </div>
        </div>
    </div>
@endsection