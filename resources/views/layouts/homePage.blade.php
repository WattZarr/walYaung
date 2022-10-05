<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WalYaung</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
    <script src="https://kit.fontawesome.com/f1b7e2c0e5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="rc">
    <!-- header -->


    <div class="container">
        <div class="row pt-3 pb-5 align-items-center">
        @if($user == null)
            <div class="col-12 col-md-4 mb-2 mb-md-3">
                <h4 class="mb-0">
                    WalYaung
                </h4>
            </div>
            <div class="col-6 col-md-4 mb-2">
                    <input type="text" name="search" class="form-control shadow-lg searchBox" placeholder="Search Item">
            </div>
            <div class="col-6 col-md-4 mb-2 d-flex justify-content-center">
                <a href="{{route('login')}}" class="btn btn-outline-dark mx-3 d-none d-md-block">Log-in</a>
                <a href="{{route('register')}}" class="btn btn-outline-dark mx-3 d-none d-md-block">Register</a>
                <a href="{{route('login')}}" class="d-inline d-md-none mx-3 text-dark">Login</a>
                <a href="{{route('register')}}" class="d-inline d-md-none mx-3 text-dark">Register</a>
            </div>
        @else
            <div class="col-12">
                <nav class="navbar navbar-expand-lg">
                  <div class="container-fluid">
                    <a class="navbar-brand mb-0" href="{{route('home')}}"><h4>WalYaung</h4></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                      <ul class="navbar-nav">
                        <li class="nav-item mx-3">
                          <a class="nav-link" aria-current="page" href="{{route('profile')}}">Profile</a>
                        </li>
                        <li class="nav-item mx-3">
                          <a class="nav-link" href="{{route('item/item-list')}}">ပစ္စည်းစာရင်းများ</a>
                        </li>
                        <li class="nav-item mx-3">
                          <a class="nav-link" href="{{route('item/solded-item',$user->id)}}">ရောင်းချပြီးသောပစ္စည်းများ</a>
                        </li>
                        <li class="nav-item mx-3">
                          <a class="nav-link" href="{{route('item/not-sold-item',$user->id)}}">မရောင်းရသေးသောပစ္စည်းများ</a>
                        </li>
                        <li class="nav-item mx-3">
                          <a class="nav-link" href="{{route('add-item')}}">ပစ္စည်းရောင်းရန်</a>
                        </li>
                      </ul>
                    </div>

                  </div>
                </nav>
            </div>

            <div class="col-6 mb-2">
            <!-- <form action="#" method="post"> -->
                <input type="text" name="search" class="form-control shadow-lg searchBox" placeholder="Search Items">
            <!-- </form> -->
        </div>
        <div class="col-6 mb-2 d-flex justify-content-center">
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="btn btn-outline-dark mx-3" type="submit">Log-Out</button>
                <!-- <a class="d-inline d-md-none mx-3 text-dark" type="submit">Log-Out</a> -->
            </form>
        </div>

        @endif

        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <div>
                <button class="btn btn-sm btn-outline-dark" onclick="dark()" id="dark-button"><i id="dm" class="fa-solid fa-moon"></i></button>
                </div>
            </div>
        </div>
    </div>


    <!-- end header -->

   @yield('content')
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({header:{'csrfToken' : '{{csrf_token()}}' }});
    </script>
    <script>

        $(document).ready(function () {
            $('#example').DataTable();
        });
        $(document).ready(function () {
            $('.searchBox').on('keyup',function(){
                var value = $(this).val();
                $.ajax({
                    type: "get",
                    url: "/", // url where search box is exit
                    data: {'search' : value}, //search is name from input type
                    success: function (data) {
                        $('.searchResult').html(data);
                    }
                });
            })
        });

        let isDark = localStorage.getItem("isDark");
        if(isDark == 1){
            dark();
            localStorage.setItem("isDark",1);
        }


        function dark(){
            $("body").toggleClass("dark");
            $(".container").toggleClass("dark");
            $(".navbar").toggleClass("navbar-dark");
            $(".navbar-brand").toggleClass("text-light");
            $(".nav-link").toggleClass("text-light");
            if($("#dark-button").hasClass("btn-outline-dark")){
                $(".btn-outline-dark").addClass("btn-outline-light").removeClass("btn-outline-dark");
            }
            else{
                $(".btn-outline-light").addClass("btn-outline-dark").removeClass("btn-outline-light");
            }
            if($("#dm").hasClass("fa-moon")){
                $("#dm").addClass("fa-sun").removeClass("fa-moon");
            }
            else{
                $("#dm").addClass("fa-moon").removeClass("fa-sun");
            }
            $("#cate").toggleClass("border-white");
            $(".cg-card").toggleClass("cg-card-dark");
            $('.searchBox').toggleClass("cg-card-dark");
            $('.navbar-toggler').toggleClass("text-light");
            $('.pcard').toggleClass("soft-dark");
            if(localStorage.getItem("isDark") == 1){
                $('.dataTables_length').removeClass("text-light");
                $('.dataTables_filter').removeClass("text-light");
                $("select").removeClass("text-light");
                $("input[type='search']").removeClass("text-light");
                localStorage.setItem("isDark",0);
            }
            else{
                $('.dataTables_length').addClass("text-light");
                $('.dataTables_filter').addClass("text-light");
                $("select").addClass("text-light");
                $("input[type='search']").addClass("text-light");
                localStorage.setItem("isDark",1);
            }


        }


    </script>
</body>
</html>
