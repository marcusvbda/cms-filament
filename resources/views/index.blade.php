@extends('layouts.default')
@php
    use App\Helpers\BladeTranslator;
@endphp

@section('title', ucfirst(BladeTranslator::__(data_get($page, 'title'))))
@section('description', ucfirst(BladeTranslator::__(data_get($page, 'description'))))

@section('content')
    <div id="home-page">
        <section id="home">
            @include('fragments.hero')
            @include('fragments.descriptionBanner')
            @include('fragments.iconsSection')
        </section>
        <section id="cases">
            @include('fragments.cases')
            @include('fragments.testimonials')
        </section>
        <section id="contact">
            @include('fragments.contact')
        </section>
    </div>
@endsection
