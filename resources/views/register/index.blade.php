@extends('layouts.main')

@section('container')
<div class="row justify-content-center mt-5">
    <div class="col-lg-5">

       

        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">Register yourself</h1>
            <form action="/register" method="POST">
            @csrf
                <div class="form-floating">
                    <input required value="{{ old('name') }}" type="text" class="form-control rounded-top @error('name')is-invalid @enderror" name="name" id="name" placeholder="name">
                    <label for="name">Name</label> 
                    @error('name')  
                    <div class="invalid-feedback"> 
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input required value="{{ old('email') }}" type="email" class="form-control @error('email')is-invalid @enderror" id="email" name="email" placeholder="name@example.com">
                    <label for="email">Email address</label>
                    @error('email')  
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input required  type="password" class="form-control rounded-bottom @error('password')is-invalid @enderror" id="password" name="password" placeholder="Password">
                    <label for="password">Password</label>
                    @error('password')  
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" name="level">
                      <option value="1">Freelancer</option>
                      <option value="2">Job Provider</option>
                    </select>
                    <label for="floatingSelect">Select ur status</label>
                  </div>
                
                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
            </form>
            <small class="d-block text-center mt-3">Already have an account? <a href="/login">Login Now</a></small>
        </main>
    </div>
</div>
    
@endsection