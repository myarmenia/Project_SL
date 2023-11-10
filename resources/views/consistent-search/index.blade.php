@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/consistent-search/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('consistent_search')}}">{{__('content.consistent_search')}}</a></li>
                </ol>
            </nav>
        </div>
    </div>


    {{--<div class="pagetitle-wrapper">--}}
        {{--<div class="pagetitle">--}}
            {{--<h1>{{ request()->routeIs(['simple_search','simple_search_*']) ? __('content.simple_search') : ''}}</h1>--}}
            {{--<nav>--}}
                {{--<ol class="breadcrumb">--}}
                    {{--<li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>--}}

                    {{--@if (request()->routeIs('simple_search*'))--}}
                        {{--<li class="breadcrumb-item"><a href="{{route('simple_search')}}">{{__('content.simple_search')}}</a></li>--}}

                        {{--@php--}}
                            {{--$last_name = explode('simple_search_', request()->route()->getName())--}}
                        {{--@endphp--}}
                    {{--@elseif (request()->routeIs('result_*'))--}}
                        {{--@php--}}
                            {{--$last_name = explode('result_', request()->route()->getName())--}}
                        {{--@endphp--}}


                    {{--@endif--}}
                    {{--@if (request()->routeIs(['simple_search_*', 'result_*']))--}}
                        {{--<li class="breadcrumb-item active"> {{__("content.".end($last_name)) }}</li>--}}
                    {{--@endif--}}

                    {{--@if (request()->routeIs('advancedsearch'))--}}
                        {{--<li class="breadcrumb-item"><a href="{{route('advancedsearch')}}">{{__('content.complex_search')}}</a></li>--}}
                    {{--@endif--}}
                {{--</ol>--}}
            {{--</nav>--}}
        {{--</div>--}}
    {{--</div>--}}



    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <x-form-error/>
                <!-- Vertical Form -->
                <form class="form consistent-form" >
                    @csrf
                    <div class="inputs row g-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" id="input1"
                                    placeholder="" name="input1" tabindex="1"
                                    value="" />
                                <label for="input1" class="form-label">1) Որոնման տեքստ</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="tegs-div"><div class="tegs-div-content">
                            </div></div>
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title get_datalist save_input_data"
                                    id="input2"
                                    placeholder=""
                                    name="source_agency_id"
                                    list="brow1"
                                    tabindex="2"
                                    value=""
                                    data-modelid="" />
                                <label for="input2" class="form-label">2) Հետևող օ/ա</label>

                            </div>
                            <datalist id="brow1" class="input_datalists" style="width: 500px;">
                                <option>hhhhhhhhhhh</option>
                            </datalist>
                        </div>
                        
                    </div>
                    <button type="submit" class="submit-btn consistent-searche-submit">Ավելացնել</button>
                </form>
                <!-- Vertical Form -->
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <x-form-error/>
                <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <div class="table_div table-div-consistent">

                        <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/"
                            data-status-url="users/change-status/" data-table-name="user" data-section-name="open">
                            <thead>
                                <tr>
                                    <th class="filter-th" data-sort="null" data-type="filter-id" style = 'width:30px' >
                                        Id
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        Որոնման տեքստ
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        Հետևող օ/ա
                                    </th>
                                    
                                    <th class="filter-th" data-sort="null" data-type="standart" style = 'width:30px'  >
                                    </th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                
                                    <tr class="current-id" data-id="">
                                        <td>1</td>
                                        <td>nkar</td>
                                        <td>Romeo</td>
                                        <td><i class="bi bi-trash3"></i></td>
                                    </tr>

                                    <tr class="current-id" data-id="">
                                        <td>2</td>
                                        <td>nkar2</td>
                                        <td>Alfred</td>
                                        <td><i class="bi bi-trash3"></i></td>
                                    </tr>
                                

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>



    @section('js-scripts')
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{{ asset('assets/js/consistent-search/script.js') }}"></script>
    @endsection
@endsection

