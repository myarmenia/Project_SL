@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.criminal_case') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a >{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.criminal_case') }}
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

                                    <th class="filter-th" >{{ __('content.number_case') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.criminal_proceedings_date') }} 
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.criminal_code') }} 
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.materials_management') }} 
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.head_department') }} 
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.instituted_units') }} 
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.name_operatives') }} 
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.worker_post') }} 
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.nature_materials_paint') }} 
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.initiated_dow') }} 
                                    </th>

                                    <th class="filter-th" > {{ __('content.face') }}</th>

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
