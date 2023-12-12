@extends('layouts.auth-app')

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.bibliography') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.bibliography') }}
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
                                        {{ __('content.created_user') }}
                                    </th>

                                    <th class="filter-th">
                                        {{ __('content.date_and_time_date') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.organ') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.document_category') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.access_level') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.reg_number') }}
                                    </th>

                                    <th class="filter-th">
                                        {{ __('content.reg_date') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.worker_take_doc') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.source_agency') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.source_address') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.short_desc') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.related_year') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.source_inf') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.information_country') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.name_subject') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.title_document') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.file') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.short_video') }}
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
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
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
