@extends('layouts.auth-app')

@section('style')

@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{__('pagetitle.report')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">{{__('pagetitle.main')}}</a></li>
                    <li class="breadcrumb-item active">{{__('pagetitle.report')}}</li>
                </ol>
            </nav>
        </div>
    </div>
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
                    <form method="POST" action="{{ route('report.generate') }}">
                        @csrf
                        <div class="d-flex justify-content-around align-items-center gap-4 my-3">
                            <div class="col-3">
                                <select class="form-select form-control" title="reportTypes" name="reportType">
                                    @foreach (config('report.report_types') as $name)
                                        <option value="{{$name}}">{{__("report.$name")}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <select class="form-select form-control" title="reportRanges" name="reportRange">
                                    @foreach (config('report.report_ranges') as $r_name)
                                        <option value="{{$r_name}}">{{__("report.$r_name")}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <!-- Button trigger generation -->
                                <button type="submit" class="btn btn-primary">
                                    {{__('button.create_new_report')}}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- Generate report part end -->
@endsection
@section('js-scripts')
    <script>
        window.addEventListener("load", function (event) {
            @error('name')

            @enderror
        });
    </script>
@endsection

