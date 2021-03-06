<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>{{ settings()->get('CompanyName') }}</title>


    <!-- Styles -->
    <link href="{{asset('css/comman.css')  }}" rel="stylesheet">
    <link href="{{asset('css/all.css')  }}" rel="stylesheet">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet" id="mainCss">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>




    <div id="app" >
@php
@endphp
        <div id="overlay"  v-on:click="toggleSidebar()">

        </div>

    @include('layouts.sidebar')
 @include('layouts.static.panel_header')






        <main class="py-4" id="main" >
            <div id="vuemain" >
                @yield('content')
            </div>

        </main>
    </div>

    <script src="{{ mix('js/manifest.js')."?".date('Ydmis') }}" ></script>
    <script src="{{ mix('js/vendor.js')."?".date('Ydmis') }}" ></script>
    <script src="{{ mix('js/app.js')."?".date('Ydmis') }}" ></script>


</body>
</html>
