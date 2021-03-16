@extends('crudbooster::admin_template')
@section('content')
<base href="./">

<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
<div class="card box-body table-responsive no-padding">

    <input type="hidden" id="getUrl" value="https://evaluaciones.motoborda.com/">
    <app-root></app-root>

    <script src="{{ asset('js/angular/dist/motobordaReports/runtime-es2015.js') }}" type="module"></script>
    <script src="{{ asset('js/angular/dist/motobordaReports/runtime-es5.js') }}" nomodule defer></script>
    <script src="{{ asset('js/angular/dist/motobordaReports/polyfills-es5.js') }}" nomodule defer></script>
    <script src="{{ asset('js/angular/dist/motobordaReports/polyfills-es2015.js') }}" type="module"></script>
    <script src="{{ asset('js/angular/dist/motobordaReports/styles-es2015.js') }}" type="module"></script>
    <script src="{{ asset('js/angular/dist/motobordaReports/styles-es5.js') }}" nomodule defer></script>
    <script src="{{ asset('js/angular/dist/motobordaReports/vendor-es2015.js') }}" type="module"></script>
    <script src="{{ asset('js/angular/dist/motobordaReports/vendor-es5.js') }}" nomodule defer></script>
    <script src="{{ asset('js/angular/dist/motobordaReports/main-es2015.js') }}" type="module"></script>
    <script src="{{ asset('js/angular/dist/motobordaReports/main-es5.js') }}" nomodule defer></script>

<div>
@endsection