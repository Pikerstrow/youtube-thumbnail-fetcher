<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">

    <!-- Url Info -->
    <meta property="og:url" content="@yield('og_url')"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="@yield('title')"/>
    <meta property="og:description" content="@yield('meta_description')"/>
    <meta property="og:image" content="{{ asset('images/favicon.png') }}"/>


    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    @if(env('APP_ENV') !== 'local')
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-82253603-6"></script>
    @endif
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-82253603-6');
    </script>

    <!-- Add sense -->
    <!--<script data-ad-client="ca-pub-6716155684505848" async-->
    <!--        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6716155684505848"
     crossorigin="anonymous"></script>
</head>
<body class="app-container">
<div id="root_element">
    @yield('header')
    @yield('content')
    @include('shared/footer')
</div>
<script src="{{ mix('js/app.js')  }}"></script>
</body>
</html>
