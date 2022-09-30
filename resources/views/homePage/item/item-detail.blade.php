@extends('layouts.homePage')

@section('content')
    <div class="container">
        <div class="row py-2">
            <div class="col-12 col-md-6 mb-3">
                <img src="{{asset('items/'.$item[0]->image)}}" class="w-100">
            </div>
            <div class="col-12 col-md-6 mb-3">
                <h3 class="fw-bolder" style="border-left:solid 10px black;">{{$item[0]->item_name}}</h3>
                <p>{{$item[0]->price}} ကျပ်</p>
                <hr>
                <h4 class="fw-bolder">ရောင်းသူ</h4>
                <p>{{$item[0]->name}}</p>
                <hr>
                <h4 class="fw-bolder">ပစ္စည်းအကြောင်း</h4>
                <p>{{$item[0]->description}}</p>
                <hr>
                <h4 class="fw-bolder">ပစ္စည်းအမျိုးအစား</h4>
                @if($item[0]->category == 1)
                    <p>လျှပ်စစ်ပစ္စည်း</p>
                @elseif($item[0]->category == 2)
                    <p>အိမ်သုံးပစ္စည်း</p>
                @elseif($item[0]->category == 3)
                    <p>သွားလာရေး ယာဉ်</p>
                @elseif($item[0]->category == 4)
                    <p>အဝတ်အထည်</p>
                @elseif($item[0]->category == 5)
                    <p>Skin care ပစ္စည်း</p>
                @elseif($item[0]->category == 6)
                    <p>အခြား</p>
                @endif
                <hr>
                <h4 class="fw-bolder">ဆက်သွယ်ရန်</h4>
                <a href="tel:+95{{$item[0]->phone}}"><i class="fa-solid fa-phone"></i>+95{{$item[0]->phone}}</a>
                <hr>
                <a href="{{route('home')}}" class="btn btn-outline-dark m-auto" style="display:block;">ပင်မစာမျက်နှာသို့</a>
            </div>
            <div class="col-12 mb-3">
                <h4 class="fw-bolder" style="border-left:10px solid black;">အမျိုးအစားတူပစ္စည်းများ</h4>
                @if (count($sitems) == 0)
                <strong class="text-black-50">အမျိုးအစားတူ ပစ္စည်းများ မရှိသေးပါ။</strong>
                @else
                    <div class="row">
                    @foreach($sitems as $sitem)
                        <div class="col-6 col-md-4">
                            <a href="{{route('item/detail',$sitem->id)}}" style="text-decoration:none;color:black">
                                <div class="card mb-3 cg-card">
                                    <div class="card-body">
                                        <div>
                                            <img src="{{asset('items/'.$sitem->image)}}" class="card-img">
                                            <p class="fw-bolder card-text">{{$sitem->name}}</p>
                                            <p class="card-text">{{$sitem->price}} ကျပ်</p>
                                        </div>
                                    </div>
                                </div>
                              </a>
                        </div>
                    @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>


@endsection
