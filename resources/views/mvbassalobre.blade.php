@extends('layouts.default')
@php
    use App\Helpers\BladeTranslator;
@endphp

@section('title', ucfirst(BladeTranslator::__(data_get($page, 'title'))))
@section('description', ucfirst(BladeTranslator::__(data_get($page, 'description'))))

@section('content')
    <div id="portifolio-page">
        <h1>content will be here</h1>
    </div>
@endsection
