@extends('layouts.auth-app')

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.mia_summary') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.mia_summary') }}
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

                                    <th class="filter-th">
                                        {{ __('content.date_registration_reports') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.content_inf') }} </th>

                                    <th class="filter-th">{{ __('content.face') }}</th>


                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>agafsfs@mail.com</td>
                                    <td>agafsfs@mail.com</td>
                                    <td>agafsfs@mail.com</td>
                                    <td>agafsfs@mail.com</td>

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
