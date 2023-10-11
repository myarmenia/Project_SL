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
@section('content')
    @if (!isset($type))
        <div class="pagetitle-wrapper">
            <div class="pagetitle">
                <h1>{{ __('sidebar.roles') }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('pagetitle.roles') }}</li>
                    </ol>
                </nav>
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
    </script>
    @section('js-scripts')
        <script src="{{ asset('assets-include/js/default.js') }}"></script>
        @yield('js-include')
    @endsection
@endsection
