@php
    $currentLocale = str_replace('_', '-', app()->getLocale() ?? 'en');
@endphp

<!doctype html>
<html lang={{ $currentLocale }}>

<head>
    <meta name="title" content="Gravity labs | @yield('title')">
    <meta property="og:title" content="Gravity labs | @yield('title')">
    <meta name="description" content="@yield('description')">
    <meta property="og:description" content="@yield('description')">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <title>Gravity labs | @yield('title')</title>
</head>

<body>
    @yield('content')
</body>

</html>
