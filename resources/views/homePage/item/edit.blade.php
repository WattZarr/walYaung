@extends('layouts.homePage')

@section('content')
    <div class="container">
        <div class="row justify-content-center py-3">
            <div class="col-12 col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                    @if(Session::has('add'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>{{Session::get('add')}}</strong>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                        <h3 class="fw-bolder mb-3">ပြောင်းလဲရန်</h3>
                        <form action="{{route('item/edit/confirm')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" value="{{$user->id}}" name="user_id">

                        <input type="hidden" value="{{$item[0]->id}}" name="item_id">

                          <div class="mb-3">
                            <label for="name" class="form-label">ပစ္စည်းအမည်</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$item[0]->item_name}}">
                            @error('name')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="image" class="form-label">ပစ္စည်းဓာတ်ပုံ</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @error('image')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="price" class="form-label">ပစ္စည်းစျေးနှုန်း</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{$item[0]->price}}">
                            @error('price')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="description" class="form-label">ပစ္စည်းအကြောင်း</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"> {{$item[0]->description}}</textarea>
                            @error('description')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="category" class="form-label">ပစ္စည်းအမျိုးအစား</label>
                            <select class="form-select" name="category">
                              <option selected disabled>ပစ္စည်းအမျိုးအစားကို ရွေးပါ။</option>
                              <option value="1">လျှပ်စစ်ပစ္စည်း</option>
                              <option value="2">အိမ်သုံးပစ္စည်း</option>
                              <option value="3">သွားလာရေး ယာဉ်</option>
                              <option value="4">အဝတ်အထည်</option>
                              <option value="5">Skin care ပစ္စည်း</option>
                              <option value="6">အခြား</option>
                            </select>
                            @error('category')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <button type="submit" class="btn btn-dark">ပြောင်းပါ</button>

                          <a href="{{route('item/item-list')}}" class="btn btn-outline-dark">ပင်မစာမျက်နှာသို့</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
