<!doctype html>
<html lang="en">

<head>
    @yield('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @vite('resources/scss/app.scss')
    <title>@yield('title')</title>
</head>

<body>
    @yield('content')
    @vite('resources/js/app.js')
</body>

</html>
