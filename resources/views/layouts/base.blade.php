<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base-url" content="{{ url('/') }}">
    <title>Uark Quiz</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
</head>
<body>
    @yield('content')
    <script src="{{ asset('build/assets/app2.js') }}"></script>
</body>
</html>
