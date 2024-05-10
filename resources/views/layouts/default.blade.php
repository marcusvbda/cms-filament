<!doctype html>
<html lang="en">

<head>
    @yield('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <title>Gravity labs | @yield('title')</title>
</head>
{{-- @php
    // dd($attributes);
@endphp --}}

<body>
    @yield('content')
</body>

</html>
