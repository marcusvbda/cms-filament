@extends('layouts.default')

@section('meta')
    {{--  --}}
@endsection

@section('title', __($page->title))

@section('content')
    <header>
        @include('components.theme.navbar')
    </header>
    <main>
        @include('components.pages.home.hero')
    </main>
@endsection
