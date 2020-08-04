<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ settings()->get('CompanyName') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>




    <div id="app" >
@php



@endphp
        <div id="overlay" v-on:click="toggleSidebar()" >

        </div>

    @include('layouts.sidebar')
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm header">
            <div class="container-fluid">
                <!--            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
-->
                <div  class="btn btn-outline-info" style="z-index: 2;" v-on:click="toggleSidebar()">
                    <span    >
                        <i class="fas fa-bars" style="display: inline-block;padding-right:10px"></i>
                        <span style="display: inline-block">Menu</span>
                        </span>
                </div>


                    <div   style="width: 98%;position: absolute;z-index: 1;" class="d-flex justify-content-center" >

                    <div>
                        <img  id="headerlogo" :class="{ 'headerlogo-small':winDown}"  src="{{ settings()->get('websiteLogo') }}">
                    </div>



                    </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="z-index: 1;">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>






        <main class="py-4" id="main" >
            <div id="vuemain" >
                @yield('content')
            </div>

        </main>
    </div>

    <script src="{{ mix('js/app.js')."?".date('Ydmis') }}" defer></script>
    <script src="https://kit.fontawesome.com/613c299ae6.js" crossorigin="anonymous"></script>
</body>
</html>
