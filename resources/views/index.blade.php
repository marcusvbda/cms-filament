@extends('layouts.default')
@php
    use App\Helpers\BladeTranslator;
@endphp

@section('title', ucfirst(BladeTranslator::__(data_get($page, 'title'))))
@section('description', ucfirst(BladeTranslator::__(data_get($page, 'description'))))

@section('content')
    <div id="home-page">
        @include('fragments.hero')
        @include('fragments.descriptionBanner')
        @include('fragments.iconsSection')
        @include('fragments.testimonials')
    </div>
@endsection
