@extends('layouts.homePage')

@section('content')
    <div class="container">
        <div class="row py-2">
            <div class="col-12 mb-3">
                <div style="border-left:10px solid black";>
                    <h4 class="mb-0 fw-bolder">
                        အမျိုးအစားများ <i class="fa-solid fa-rectangle-list mb-0"></i>
                    </h4>
                </div>
            </div>
            <div class="col-4">
                <a href="{{route('item/filter',1)}}" class="text-decoration-none text-black">
                <div class="card text-center mb-3">
                    <div class="card-body cg-card">
                    <i class="fa-solid fa-lightbulb"></i> <span class="ms-2">လျှပ်စစ်ပစ္စည်း</span>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-4">
                <a href="{{route('item/filter',2)}}" class="text-decoration-none text-black">
                <div class="card text-center mb-3">
                    <div class="card-body cg-card">
                    <i class="fa-solid fa-tv"></i> <span class="ms-2">အိမ်သုံးပစ္စည်း</span>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-4">
                <a href="{{route('item/filter',3)}}" class="text-decoration-none text-black">
                <div class="card text-center mb-3">
                    <div class="card-body cg-card">
                    <i class="fa-solid fa-car"></i> <span class="ms-2">သွားလာရေး ယာဉ်</span>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-4">
                <a href="{{route('item/filter',4)}}" class="text-decoration-none text-black">
                    <div class="card text-center mb-3">
                        <div class="card-body cg-card" >
                        <i class="fa-solid fa-shirt"></i> <span class="ms-2">အဝတ်အထည်</span>
                        </div>
                    </div>
                </a>
            </div>
                <div class="col-4">
                    <a href="{{route('item/filter',5)}}" class="text-decoration-none text-black">
                    <div class="card text-center mb-3">
                        <div class="card-body cg-card">
                        <i class="fa-solid fa-face-smile"></i> <span class="ms-2">Skin care ပစ္စည်း</span>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="{{route('item/filter',6)}}" class="text-decoration-none text-black">
                    <div class="card text-center mb-3">
                        <div class="card-body cg-card">
                        <i class="fa-solid fa-bars"></i><span class="ms-2">အခြား</span>
                        </div>
                    </div>
                    </a>
                </div>
        </div>

        <!-- items -->
        <div class="row py-2">
            <div>
                <div class="row searchResult">

                </div>
            </div>
            @foreach($items as $item)
            <div class="col-6 col-md-4">
              <a href="{{route('item/detail',$item->id)}}" style="text-decoration:none;color:black">
                <div class="card mb-3 cg-card">
                    <div class="card-body">
                        <div>
                            <img src="{{asset('items/'.$item->image)}}" class="card-img">
                            <p class="fw-bolder card-text">{{$item->item_name}}</p>
                            <p class="card-text">{{$item->price}} ကျပ်</p>
                        </div>
                    </div>
                </div>
              </a>
            </div>
            @endforeach
        </div>
        <!-- end items -->

    </div>


@endsection
