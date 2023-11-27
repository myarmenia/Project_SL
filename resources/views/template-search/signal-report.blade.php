@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/template-search/signal-report.css') }}">
@endsection

@section('content')

    <x-breadcrumbs :title="__('content.report_search')" />

    <!-- End Page Title -->


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <!-- Generate report part start -->
    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <form method="POST" action="{{ route('report.generate') }}">
                        @csrf
                        <div class="signal-report">
                            {{-- <label for="">{{ __('content.report_search') }}</label> --}}
                            <select name="reportType" class="month-select form-select mb-3">
                                @foreach (config('report.report_types') as $name)
                                    <option value="{{$name}}">{{__("report.$name")}}</option>
                                @endforeach
                            </select>
                            <div class="report-selects">
                                <select name="reportRange" class="month-select form-select" id="mySelect">
                                    @foreach (config('report.report_ranges') as $r_name)
                                        <option id="option_{{$r_name}}"
                                                value="{{$r_name}}">{{__("report.$r_name")}}</option>
                                    @endforeach
                                </select>
                                <select name="year" class="year-select form-select" id="select2" style="display: block"></select>
                            </div>

                        </div>
                        <div class="date_div">
                            <input type="date" name="startDate" id="otherInput" class="form-control"
                                   style="display: none; width:20%"/>
                            <pre id="line" style="display: none; margin-top:10px"> -- </pre>
                            <input type="date" name="endDate" id="otherInput2" class="form-control"
                                   style="display: none; width:20%"/>
                        </div>
                        <div class="export-button">
                            <button type="submit"
                                    class="btn btn-primary report-button">{{ __('content.report_search') }}</button>
                        </div>
                    </form>
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
