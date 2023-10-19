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
                        <li class="breadcrumb-item"><a href="{{route('simple_search')}}">{{__('content.simple_search')}}</a></li>

                        @if (request()->routeIs('simple_search_*'))
                            @php
                                $last_name = explode('simple_search_', request()->route()->getName())
                            @endphp
                        @elseif (request()->routeIs('result_*'))
                            @php
                                $last_name = explode('result_', request()->route()->getName())
                            @endphp
                        @else
                        @endif
                        @if (request()->routeIs(['simple_search_*', 'result_*']))
                            <li class="breadcrumb-item active"> {{__("content.".end($last_name)) }}</li>
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

        let trs_err = `{{ __('content.err') }}`
        let trs_hide = `{{ __('content.hide') }}`
        let trs_show = `{{ __('content.show') }}`
        let trs_break_link = `{{ __('content.break_link') }}`
        let trs_are_you_sure = `{{ __('content.are_you_sure') }}`
        let trs_file_delete = `{{ __('content.file_delete') }}`
        let trs_keep_signal = `{{ __('content.keep_signal') }}`

        let trs_dictionary = `{{ __('content.dictionary') }}`
        let trs_no_id = `{{ __('content.no_id') }}`
        let trs_save = `{{ __('content.save') }}`
        let trs_enter_number = `{{ __('content.enter_number') }}`
        let trs_enter_correct = `{{ __('content.enter_correct') }}`

    </script>
    @section('js-scripts')
        <script src="{{ asset('assets-include/js/default.js') }}"></script>
        @yield('js-include')
    @endsection
@endsection