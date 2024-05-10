@extends('layouts.default')
@php
    use App\Helpers\BladeTranslator;
@endphp

@section('title', ucfirst(BladeTranslator::__($page->title)))
@section('description', ucfirst(BladeTranslator::__($page->description)))

@section('content')
    <header>
        @include('components.theme.navbar')
    </header>
    <main>
        @include('components.pages.home.hero')
        @include('components.pages.home.description-banner')
    </main>
@endsection
