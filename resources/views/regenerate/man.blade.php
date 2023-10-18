@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.man') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.man') }}
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

                                    <th class="filter-th">Id </th>

                                    <th class="filter-th">
                                        {{ __('content.last_name') }} </th>
                                    <th class="filter-th">
                                        {{ __('content.first_name') }} </th>
                                    <th class="filter-th">
                                        {{ __('content.middle_name') }} </th>
                                    <th class="filter-th">
                                        {{ __('content.date_of_birth_d') }} </th>
                                    <th class="filter-th">{{ __('content.date_of_birth_m') }}
                                    </th>
                                    <th class="filter-th">
                                        {{ __('content.date_of_birth_y') }} </th>
                                    <th class="filter-th">
                                        {{ __('content.first_name') }} {{ __('content.last_name') }}
                                        {{ __('content.middle_name') }} </th>
                                    <th class="filter-th">
                                        {{ __('content.place_of_birth') }} </th>
                                    <th class="filter-th">
                                        {{ __('content.place_of_birth_area') }}</th>
                                    <th class="filter-th">
                                        {{ __('content.place_of_birth_settlement') }} </th>
                                    <th class="filter-th">
                                        {{ __('content.approximate_year') }}</th>
                                    <th class="filter-th">
                                        {{ __('content.passport_number') }}</th>
                                    <th class="filter-th">
                                        {{ __('content.gender') }} </th>
                                    <th class="filter-th">
                                        {{ __('content.nationality') }} </th>
                                    <th class="filter-th">
                                        {{ __('content.citizenship') }}
                                    </th>
                                    <th class="filter-th">
                                        {{ __('content.knowledge_of_languages') }} </th>
                                    <th class="filter-th">
                                        {{ __('content.attention') }}
                                    </th>
                                    <th class="filter-th">
                                        {{ __('content.additional_information_person') }} </th>
                                    <th class="filter-th">
                                        {{ __('content.worship') }} </th>
                                    <th class="filter-th">
                                        {{ __('content.occupation') }}</th>
                                    <th class="filter-th">
                                        {{ __('content.country_carrying_out_search') }}</th>
                                    <th class="filter-th">
                                        {{ __('content.operational_category_person') }}</th>
                                    <th class="filter-th" >
                                        {{ __('content.declared_wanted_list_with') }}</th>
                                    <th class="filter-th" >
                                        {{ __('content.home_monitoring_start') }}</th>
                                    <th class="filter-th" >
                                        {{ __('content.end_monitoring_start') }}</th>
                                    <th class="filter-th">
                                        {{ __('content.education') }}
                                    </th>
                                    <th class="filter-th">
                                        {{ __('content.party') }}</th>
                                    <th class="filter-th">
                                        {{ __('content.alias') }}</th>
                                    <th class="filter-th">
                                        {{ __('content.face_opened') }}</th>
                                    <th class="filter-th">
                                        {{ __('content.source_inf') }}</th>
                                    <th class="filter-th">
                                        {{ __('content.short_photo') }}</th>

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
