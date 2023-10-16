@extends('layouts.auth-app')
@section('style')
    {{-- <link href="{{ asset('assets/css/roles/style.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('assets-include/css/jquery.fancybox.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets-include/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets-include/js/jquery.fancybox.js') }}"></script>
    <link href="{{ asset('assets-include/css/kendo.common.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-include/css/kendo.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-include/css/styles.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets-include/js/kendo.all.min.js') }}"></script>
    <script src="{{ asset('assets-include/js/fileuploader.js') }}"></script>
    <script src="{{ asset('assets-include/js/ru.js') }}"></script>
@endsection
@yield('include-css')
@section('content')

    @if (!isset($type))
        <div class="pagetitle-wrapper">
            <div class="pagetitle">
                <h1>{{ request()->routeIs(['simple_search','simple_search_*']) ? __('content.simple_search') : ''}}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>
                        @if (request()->routeIs('simple_search_*'))
                            @php
                                $last_name = explode('simple_search_', request()->route()->getName())
                            @endphp
                            <li class="breadcrumb-item active">{{ request()->routeIs('simple_search_*') ? __("content.$last_name[1]") : ''}}</li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
    @else
        <div class="pagetitle-wrapper">
            <div class="pagetitle">

            </div>
        </div>

    @endif
    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @yield('content-include')
                </div>
            </div>
        </div>
    </section>


    <script>
        let or = `{{ __('content.or') }}`
        let and = `{{ __('content.and') }}`
        let lang = `{{ app()->getLocale() }}`
    </script>
    @section('js-scripts')
        <script src="{{ asset('assets-include/js/default.js') }}"></script>
        @yield('js-include')
    @endsection
@endsection
