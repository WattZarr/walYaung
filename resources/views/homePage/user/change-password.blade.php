@extends('layouts.homePage')

@section('content')
    <div class="container">
        <div class="row justify-content-center py-3">
            <div class="col-12 col-md-8">
                <div class="card shadow-lg pcard">
                    <div class="card-body">
                    @if(Session::has('changePass'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>{{Session::get('changePass')}}</strong>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                        <h3 class="fw-bolder mb-3">Change Password</h3>
                        <form action="{{route('profile/change-password')}}" method="post">
                        @csrf

                        <input type="hidden" value="{{$user->id}}" name="user_id">

                          <div class="mb-3">
                            <label for="oldPassword" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                            @error('oldPassword')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                            @if(Session::has('op'))
                                <span class="text-danger">{{Session::get('op')}}</span>
                            @endif
                          </div>
                          <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword">
                            @error('newPassword')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                            @error('confirmPassword')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <button type="submit" class="btn btn-dark">Change</button>

                          <a href="{{route('profile')}}" class="btn btn-outline-dark">Back</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

