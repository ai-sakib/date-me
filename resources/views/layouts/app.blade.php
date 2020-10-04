<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('photos/logo.png') }}" type="image/png" sizes="16x16">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Date Me</title>

    <!-- Scripts -->
    

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/457469e482.js" crossorigin="anonymous"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>
<body>
    <style type="text/css">
        .index_table {
            padding: 0.5rem !important;

        }

    </style>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('photos/logo.png') }}" type="image/png" height="27" width="27"> Date Me 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li>
                                <a class="nav-link" href="{{ route('user-list') }}" >
                                    User List
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                 

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('profile') }}" class="dropdown-item">
                                        <i class="fas fa-user"></i>&nbsp;{{ __('Profile') }}
                                    </a>
                                    <a href="{{ route('change-password') }}" class="dropdown-item">
                                        <i class="fas fa-key"></i>&nbsp;{{ __('Change Password') }}
                                    </a>
                                    <a style="cursor: pointer;" onclick="updateLocation()" class="dropdown-item">
                                        <i class="fas fa-location-arrow"></i>&nbsp;{{ __('Update Location') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>&nbsp;{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
              @include('error.msg')
            </div>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script type="text/javascript">
        function updateLocation() {
            $.confirm({
                title: '',
                content: '<div style="padding-top:35px;padding-bottom:15px"><h3 class="text-center"><strong class="text-success">Are you sure to update location ?</strong></h3></div>',
                buttons: {
                    confirm: {
                        text: 'Update',
                        btnClass: 'btn-blue',
                        action: function(){
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(showPosition);
                                // if(!i){
                                //    $.alert({
                                //     title:"Whoops!",
                                //     content:"<hr><strong class='text-danger'>Please turn on location from your brower for this site !</strong><hr>",
                                //     type:"red"
                                //  });
                                // }
                            } else { 
                                $.alert({
                                    title:"Whoops!",
                                    content:"<hr><strong class='text-danger'>Geolocation is not supported in this brower !</strong><hr>",
                                    type:"red"
                                 });
                            }
                        }
                    },
                    close: {
                        text: 'Cancel',
                        btnClass: 'btn-default',
                        action: function(){
                            
                        }
                    }
                }
            });  
        }
        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            if(latitude > 0 && longitude > 0){
              $.ajax({
                  url: '{{ url('update-location') }}/'+latitude+'&'+longitude,
                  type: 'GET',
                  dataType: 'json',
              })
              .done(function(response) {
                if(response.success){
                    location.reload();
                }
              });
            }else{
                $.alert({
                    title:"Whoops!",
                    content:"<hr><strong class='text-danger'>Please turn on location from your brower for this site !</strong><hr>",
                    type:"red"
                 });
            }
          
        }
    </script>
    {{-- <script src="{{ asset('/') }}plugins/fontawesome-free/js/all.js"></script> --}}
</body>
</html>
