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
<body class="app sidebar-show aside-menu-show">
<header class="app-header navbar">
    <!-- Header content here -->
</header>
<div class="app-body">
    <div class="sidebar">
        <!-- Sidebar content here -->
    </div>
    <main class="main">
        <!-- Main content here -->
    </main>
    <aside class="aside-menu">
        <!-- Aside menu content here -->
    </aside>
</div>
<footer class="app-footer">
    <!-- Footer content here -->
</footer>

    <script src="{{ mix('js/manifest.js')."?".date('Ydmis') }}" defer></script>
    <script src="{{ mix('js/vendor.js')."?".date('Ydmis') }}" defer></script>
    <script src="{{ mix('js/app.js')."?".date('Ydmis') }}" defer></script>
{{--    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>--}}

{{--    <script src="https://kit.fontawesome.com/613c299ae6.js" crossorigin="anonymous"></script>--}}
</body>
</html>
