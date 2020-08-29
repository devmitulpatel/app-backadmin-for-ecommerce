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

@php

$url="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 800 400'%3E%3Cdefs%3E%3CradialGradient id='a' cx='396' cy='281' r='514' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23D18'/%3E%3Cstop offset='1' stop-color='%23330000'/%3E%3C/radialGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='400' y1='148' x2='400' y2='333'%3E%3Cstop offset='0' stop-color='%23FA3' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23FA3' stop-opacity='0.5'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23a)' width='800' height='400'/%3E%3Cg fill-opacity='0.4'%3E%3Ccircle fill='url(%23b)' cx='267.5' cy='61' r='300'/%3E%3Ccircle fill='url(%23b)' cx='532.5' cy='61' r='300'/%3E%3Ccircle fill='url(%23b)' cx='400' cy='30' r='300'/%3E%3C/g%3E%3C/svg%3E";
$bgStyle[]='background-color: #330000;';
$bgStyle[]='background-image: url("'.$url.'");';
$bgStyle[]='background-attachment: fixed;';
$bgStyle[]='background-size: cover;';
$bgStyle=implode('',$bgStyle);
@endphp

<body style="{{implode('',[$bgStyle])}}">




<div id="app"   >

      <main class="py-4" id="main" >
        <div id="vuemain" >
            @yield('content')
        </div>

      </main>
</div>

<script src="{{ mix('js/manifest.js')."?".date('Ydmis') }}" defer></script>
<script src="{{ mix('js/vendor.js')."?".date('Ydmis') }}" defer></script>
<script src="{{ mix('js/app.js')."?".date('Ydmis') }}" defer></script>
{{--    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>--}}

{{--    <script src="https://kit.fontawesome.com/613c299ae6.js" crossorigin="anonymous"></script>--}}
</body>
</html>
