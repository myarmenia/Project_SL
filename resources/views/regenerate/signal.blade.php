@extends('layouts.auth-app')

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.signal') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.signal') }}
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

                                    <th class="filter-th" > {{ __('content.reg_number_signal') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.contents_information_signal') }}</th>

                                    <th class="filter-th" >{{ __('content.line_which_verified') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.check_status_charter') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.qualifications_signaling') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.source_category') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.checks_signal') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.department_checking') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.unit_testing') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.name_checking_signal') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.worker_post') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.date_registration_division') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.check_date') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.check_previously') }}
                                    </th>

                                    <th class="filter-th" >{{ __('content.count') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.date_actual') }}</th>

                                    <th class="filter-th" >{{ __('content.amount_overdue')}}</th>

                                    <th class="filter-th" >
                                        {{ __('content.useful_capabilities') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.signal_results') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.measures_taken') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.according_result_dow') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.brought_signal') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.department_brought') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.unit_brought') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.name_operatives') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.worker_post') }}</th>

                                    <th class="filter-th" > {{ __('content.keep_signal') }}</th>

                                    <th class="filter-th" > {{ __('content.face') }}</th>


                                </tr>

                            </thead>
                            <tbody>

                                <tr>
                                    <td></td>
                                    <td>26409</td>
                                    <td>Xazaryan</td>
                                    <td>Garik</td>
                                    <td>Hrachi</td>
                                    <td>1</td>
                                    <td>6</td>
                                    <td>1986</td>
                                    <td>Artur Hrachi Xazaryan</td>
                                    <td>RD</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
