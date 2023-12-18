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

    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">

@endsection

@yield('include-css')


@section('content')

    @if (!isset($type))


        {{-- <div class="pagetitle-wrapper">
            <div class="pagetitle">
                <h1>{{ request()->routeIs(['simple_search', 'simple_search_*']) ? __('content.simple_search') : '' }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('pagetitle.main') }}</a></li>

                        @if (request()->routeIs('simple_search*'))

                            @if( Request::segment(3) == 'simple_search')
                                <li class="breadcrumb-item"><a>{{ __('content.simple_search') }}</a></li>
                            @else
                                <li class="breadcrumb-item"><a href="{{route('simple_search')}}">{{ __('content.simple_search') }}</a></li>
                            @endif

                            @php
                                $last_name = explode(
                                    'simple_search_',
                                    request()
                                        ->route()
                                        ->getName(),
                                );
                            @endphp
                        @elseif (request()->routeIs('result_*'))

                            @php
                                $last_name = explode(
                                    'result_',
                                    request()
                                        ->route()
                                        ->getName(),
                                );
                            @endphp

                        @endif
                        @if (request()->routeIs(['simple_search_*', 'result_*']))
                            <li class="breadcrumb-item active" href="#"> {{ __('content.' . end($last_name)) }}</li>
                        @endif

                        @if (request()->routeIs('advancedsearch'))
                            @if( Request::segment(2) == 'advancedsearch')
                                <li class="breadcrumb-item"><a
                                       >{{ __('content.complex_search') }}</a></li>
                            @else
                                <li class="breadcrumb-item"><a
                                        href="{{ route('advancedsearch') }}">{{ __('content.complex_search') }}</a></li>
                            @endif

                        @endif
                    </ol>
                </nav>
            </div>
        </div> --}}
    @else
        {{-- <div class="pagetitle-wrapper">
            <div class="pagetitle">

            </div>
        </div> --}}
    @endif

    <section class="section">
        <div class="col">

            <div class="card">

                <div class="card-body">

                    @yield('content-include')

                    @if (session()->has('not_find_message'))
                        <div class="alert alert-danger" role="alert" style="margin-top: 0.5rem;">
                            {{ session()->get('not_find_message') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>



    {{-- @include('components.delete-modal') --}}

    <script>
        let or = `{{ __('content.or') }}`
        let and = `{{ __('content.and') }}`
        let not_equal = `{{ __('content.not_equal') }}`

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
@endsection
@yield('js-include')

{{-- <script src="{{ asset('assets-include/js/script.js') }}"></script> --}}


@endsection
