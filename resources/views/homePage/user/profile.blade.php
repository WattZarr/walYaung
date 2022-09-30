@extends('layouts.homePage')

@section('content')
    <div class="container">
        <div class="row pt-2 pb-5 d-flex justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <hr>
                            <h4 class="fw-bolder">PROFILE<i class="fa-regular fa-user mx-2"></i></h4>
                            <hr>
                            <p class="h5 m-3"><span class="text-black-50">Name</span> : {{$user->name}}</p>
                            <p class="h5 m-3"><span class="text-black-50">Email</span> : {{$user->email}}</p>
                            <p class="h5 m-3"><span class="text-black-50">Phone</span> : +95{{$user->phone}}</p>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <a href="{{route('profile/edit')}}" class="btn btn-outline-dark mb-3">သင်၏အချက်အလက်များကိုပြောင်းလဲရန်</a>
                                </div>
                                <div class="col-12 col-md-6">
                                    <a href="{{route('profile/change-password')}}" class="btn btn-outline-dark mb-3">စကားဝှက်ကိုပြောင်းရန်</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
