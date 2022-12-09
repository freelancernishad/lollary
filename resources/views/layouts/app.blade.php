<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset("js/dataTables.bootstrap5.min.css") }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset("js/dataTables.bootstrap5.min.js") }}"></script>
    <script src="{{ asset("js/jquery.dataTables.min.js") }}"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        marquee {
    background: linear-gradient(45deg, #e41c1c, #931313);
    color: white;
    font-size: 22px;
}



div#example_length {
    width: 50%;
    float: left;
}

div#example_filter {
    width: 50%;
    float: right;
}
select,input,input[type=text], input[type=email], input[type=password], input[type=Number] {
        width: 100%;
        margin: 8px 0;
        padding: 12px 20px;
        display: inline-block;
        border: 2px solid #008000;
        box-sizing: border-box;
    }
    div#example_paginate a {
    padding: 6px 9px;
    background: green;
    margin: 2px;
    color: white;
    text-decoration: none;
    cursor: pointer;
}
a.paginate_button.current {
    background: red !important;
}
    </style>



</head>
<body style="font-family: sans-serif !important;">
    <div id="app" >


        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-s" style="background: #a2ed0f !important;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img style="width: 60px;" src="{{ asset('img/logo.png') }}">
                </a>

                @if(Auth::user())

                @if(Auth::user()->role=='admin')


                <div class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ __('Users') }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.index') }}">
                            {{ __('Users List') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('user.create') }}">
                            {{ __('New User') }}
                        </a>
                    </div>

                </div>

                @endif
                @endif



                <div class="menuSection d-flex">
                <select class="form-control changeLang mr-1" style="width:75px;margin-right: 7px;">
                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="ml" {{ session()->get('locale') == 'ml' ? 'selected' : '' }}>Malay</option>
                    <option value="hi" {{ session()->get('locale') == 'hi' ? 'selected' : '' }}>Hindi</option>
                    <option value="th" {{ session()->get('locale') == 'th' ? 'selected' : '' }}>Thai</option>
                    <option value="bn" {{ session()->get('locale') == 'bn' ? 'selected' : '' }}>Bangla</option>
                    <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Arabic</option>
                </select>



                @if(Auth::user())



                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img style="width: 50px;height: 50px;border: 3px solid #fc047e;border-radius: 50%;padding: 4px;" src="{{ asset(Auth::user()->Photo) }}" alt="">
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

                @endif



            </div>

                {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="display: none !important;">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                                </li> --}}
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else


                    @if(Auth::user()->role=='admin')


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Users') }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.index') }}">
                                        {{ __('Users List') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.create') }}">
                                        {{ __('New User') }}
                                    </a>
                                </div>

                            </li>

                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                        <li class="nav-item dropdown">
                            <select class="form-control changeLang">
                                <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                                <option value="ml" {{ session()->get('locale') == 'ml' ? 'selected' : '' }}>Malay</option>
                                <option value="hi" {{ session()->get('locale') == 'hi' ? 'selected' : '' }}>Hindi</option>
                                <option value="th" {{ session()->get('locale') == 'th' ? 'selected' : '' }}>Thai</option>
                                <option value="bn" {{ session()->get('locale') == 'bn' ? 'selected' : '' }}>Bangla</option>
                                <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Arabic</option>
                            </select>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <marquee style="margin-bottom: -7px;" behavior="" direction="">{{ __('messages.running') }}</marquee>





        <main class="">

            @yield('content')
        </main>
    </div>


    <script>
        $(document).ready(function () {
        $('#example').DataTable();
    });
    </script>
    <script type="text/javascript">

        var url = "{{ route('changeLang') }}";

        $(".changeLang").change(function(){
            window.location.href = url + "?lang="+ $(this).val();
        });

    </script>


</body>
</html>
