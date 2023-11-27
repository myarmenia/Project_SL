@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/fusion/edit.css') }}">
@endsection


@section('content')

    <x-breadcrumbs :title="__('content.' . Request::segment(3))" :crumbs="[['name' => __('content.fusion'), 'route' => 'fusion.index', 'route_param' => '']]" />
    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                @if (session()->has('result'))
                    {{ session()->get('result') }}
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="spiner-block">
                        <div id="loadingIndicator" class="spinner" style="display: none;"></div>
                    </div>
                    <form action="{{ route('fusion_check_ids') }}" method="POST">
                        <div class="find_block">

                            <div class="first-id-block">
                                <label>{{ __('content.first_id') }}</label>
                                <input type="number" min="0" class="first-id-input form-control id-input"
                                    name="first_id">

                            </div>
                            @error('first_id')
                                <div class="error fusion_edit_error">{{ $message }}</div>
                            @enderror
                            <div class="second-id-block">
                                <label>{{ __('content.second_id') }}</label>
                                <input type="number" min="0" class="second-id-input form-control id-input"
                                    name="second_id">

                            </div>
                            @error('second_id')
                                <div class="error fusion_edit_error">{{ $message }}</div>
                            @enderror
                            <input type="hidden" name="name" value="{{ request()->route()->name }}">
                            <div class="button-block">
                                <button class="btn btn-primary">{{ __('content.start_fusion') }}</button>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </section>
    <div>

    @section('js-scripts')
        <script src='{{ asset('assets/js/fusion/index.js') }}'></script>
    @endsection

@endsection
