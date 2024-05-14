@extends('layouts.default')
@php
    use App\Helpers\BladeTranslator;
@endphp

@section('title', ucfirst(BladeTranslator::__(data_get($page, 'title'))))
@section('description', ucfirst(BladeTranslator::__(data_get($page, 'description'))))

@section('content')
    <header>
        @include('components.theme.navbar')
    </header>
    <main>
        @include('components.pages.home.hero')
        @include('components.pages.home.description-banner')
        @include('components.pages.home.icons-section')
    </main>
@endsection
