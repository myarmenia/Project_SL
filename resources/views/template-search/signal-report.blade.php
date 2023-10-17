@extends('layouts.auth-app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/template-search/signal-report.css') }}">
    
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('content.report_search_signal') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('content.search') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('content.report_search_signal') }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="signal-report">
                        <label for="">{{ __('content.report_search_signal') }}</label>
                        <div class="report-selects">
                            <select class=" month-select form-select form-select-lg mb-3">
                                <option>1 {{ __('content.half_year') }}</option>
                                <option>2 {{ __('content.half_year') }}</option>
                                <option>1 {{ __('content.quarter') }}</option>
                                <option>2 {{ __('content.quarter') }}</option> 
                                <option>3 {{ __('content.quarter') }}</option>
                                <option>4 {{ __('content.quarter') }}</option>
                                <option>{{ __('content.year') }}</option>
                            </select>
                            <select class="year-select form-select form-select-lg mb-3"></select>
                        </div>
                    </div>
                    <div class="export-button">
                        <button class="btn btn-primary report-button">{{ __('content.report_search') }}</button>
                    </div>
                </div>
                <div id="countries-list"></div>
            </div>
        </div>
    </section>
    <div>

    @section('js-scripts')
    <script src='{{ asset('assets/js/template-search/signal-report.js') }}'></script>
    @endsection

@endsection
