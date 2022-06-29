@extends('layouts.main')
@section('container')
 <div class="card col-11 mx-auto p-1" style="min-height: 500px">
    <div class="table-responsive">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}    
            </div>        
        @endif
        <table class="table table-striped table-sm" border="0">
            <thead>
              <tr class="table-primary">
                <th class="text-center" scope="col">#</th>
                <th scope="col">Title</th>
                <th class="text-center" scope="col">status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($lamaran as $lamar )
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $lamar->job->title }}</td>
                        <td class="text-center">{{ $lamar->status_lamaran }}</td>
                        <td>
                            <a href="lamar/{{ $lamar->id }}" class="badge bg-info">Detail</a>
                            <form action="lamar/{{ $lamar->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                    
            </tbody>
        </table>
    </div>
 </div>
@endsection