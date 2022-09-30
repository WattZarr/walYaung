@extends('layouts.homePage')

@section('content')
    <div class="container">
        <div class="row py-2">
            <div class="col-12 p-3">
            <h4 class="fw-bolder mb-3">ပစ္စည်းစာရင်းများ</h4>

            @if(Session::has('edit'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>{{Session::get('edit')}}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(Session::has('sold'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>{{Session::get('sold')}}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="demo-html">
                    <table id="example" class="display dataTable" style="width: 100%;" aria-describedby="example_info">
                        <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th>
                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Image</th>
                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"aria-label="Salary: activate to sort column ascending">price</th>
                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"aria-label="Office: activate to sort column ascending">Description</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td class="sorting_1">{{$item->item_name}}</td>
                                <td><img src="{{asset('items/'.$item->image)}}" style="width:10%"></td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->description}}</td>
                                <td>
                                    <a href="{{route('item/edit',$item->id)}}" class="btn btn-outline-dark">Edit</a>
                                </td>
                                <td><a href="{{route('item/sold',$item->id)}}" class="btn btn-outline-primary">Sold</a></td>
                                <td><a href="" class="btn btn-outline-danger">Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


@endsection
