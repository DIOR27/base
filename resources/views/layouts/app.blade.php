<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"
        content="ie=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png"
        rel="icon"
        type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
        rel="stylesheet">

    <link href="{{ asset('argon/css/bootstrap.min.css') }}"
        rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css"
        rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css"
        href="{{ asset('argon') }}/css/argon.css?v=1.0.0"
        rel="stylesheet">

    <!-- jQuery AtWho -->
    <link href="{{ asset('argon/css/jquery.atwho.min.css') }}"
        rel="stylesheet" />

    <!-- Simple Notify -->
    <link href="{{ asset('argon/css/simple-notify.min.css') }}"
        rel="stylesheet" />
</head>

<body class="{{ $class ?? '' }}">
    @auth()
        <form id="logout-form"
            action="{{ route('logout') }}"
            method="POST"
            style="display: none;">
            @csrf
        </form>
        @include('layouts.navbars.sidebar')
    @endauth

    <div class="main-content">
        @include('layouts.navbars.navbar')
        @yield('content')
    </div>

    @include('layouts.feedback')

    @guest()
        @include('layouts.footers.guest')
    @endguest

    <script src="{{ asset('argon/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/jquery.atwho/dist/jquery.atwho.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/simple-notify/dist/simple-notify.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/sweetalert2/dist/sweetalert2.net_npm_sweetalert2@11') }}"></script>

    @stack('js')

    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
</body>

</html>
