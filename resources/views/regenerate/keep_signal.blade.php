@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.keep_signal') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a >{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.keep_signal') }}
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
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table">
                            <thead>
                                <tr>
                                    <th class="filter-th">{{ __('sidebar.operator') }}</th>

                                    <th class="filter-th" >Id</th>

                                    <th class="filter-th" >
                                        {{ __('content.management_signal') }} </th>

                                    <th class="filter-th" >
                                        {{ __('content.department_checking_signal') }} 
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.unit_signal') }} 
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.name_operatives') }} 
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.worker_post') }} 
                                    </th>

                                    <th class="filter-th">
                                        {{ __('content.start_checking_signal') }} 
                                    </th>

                                    <th class="filter-th">
                                        {{ __('content.end_checking_signal') }} 
                                    </th>

                                    <th class="filter-th">
                                        {{ __('content.date_transfer_unit') }} 
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.unit_signal_transmitted') }} 
                                    </th>

                                </tr>

                            </thead>
                            <tbody>

                                <tr>
                                    <td></td>
                                    <td>26409</td>
                                    <td>knjnjnjnjnjn</td>
                                    <td>dkdk</td>
                                    <td>dkfk</td>
                                    <td>dkkffk</td>
                                    <td>dkdk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                </tr>

                               
                            </tbody>
                        </table>

                    </div>


                </div>
                <div id="countries-list"></div>
            </div>
        </div>
    </section>
    <div>

    @section('js-scripts')
        <script src='{{ asset('assets/js/regenerate/regenerate-dinamic-table.js') }}'></script>
    @endsection

@endsection
