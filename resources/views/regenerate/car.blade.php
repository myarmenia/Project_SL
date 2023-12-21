@extends('layouts.auth-app')

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.car') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a >{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.car') }}
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

                                    <th class="filter-th">Id</th>

                                    <th class="filter-th" >
                                        {{ __('content.car_cat') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.mark') }} </th>

                                    <th class="filter-th" >
                                        {{ __('content.color') }} </th>

                                    <th class="filter-th" >
                                        {{ __('content.car_number') }}</th>

                                    <th class="filter-th">{{ __('content.count') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.additional_data') }}
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
