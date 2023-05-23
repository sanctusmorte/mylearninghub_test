<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css?ver=1') }}">


    <title>MyLearningHub</title>
</head>

<body>

<div id="app">
    @yield('content')
</div>

<script src="{{ asset('js/app.js') }}?time={{ time() }}"></script>
<script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
</body>
</html>
