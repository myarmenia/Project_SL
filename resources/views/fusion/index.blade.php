@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/fusion/index.css') }}">
    /
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.phone') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.phone') }}
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
                    <div class="spiner-block">
                        <div id="loadingIndicator" class="spinner" style="display: none;"></div>
                    </div>
                    <div class="find_block">
                        <div class="first-id-block">
                            <label >{{ __('content.first_id') }}</label>
                            <input type="number" min="0" class="first-id-input form-control id-input">
                        </div>
                        <div class="second-id-block">
                            <label>{{ __('content.second_id') }}</label>
                            <input type="number" min="0" class="second-id-input form-control id-input">
                        </div>
                        <div class="button-block">
                            <button class="btn btn-primary">{{ __('content.start_fusion') }}</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <div>

    @section('js-scripts')
    <script src='{{ asset('assets/js/fusion/index.js') }}'></script>
    @endsection

@endsection
