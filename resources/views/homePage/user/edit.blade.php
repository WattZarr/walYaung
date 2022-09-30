@extends('layouts.homePage')

@section('content')
    <div class="container">
        <div class="row justify-content-center py-3">
            <div class="col-12 col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                    @if(Session::has('edit'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>{{Session::get('edit')}}</strong>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                        <h3 class="fw-bolder mb-3">Edit</h3>
                        <form action="{{route('profile/edit')}}" method="post">
                        @csrf

                        <input type="hidden" value="{{$user->id}}" name="user_id">

                          <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                            @error('name')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                            @error('email')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone" name="phone" value="0{{$user->phone}}">
                            @error('phone')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <button type="submit" class="btn btn-dark">Edit</button>

                          <a href="{{route('profile')}}" class="btn btn-outline-dark">Back</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
