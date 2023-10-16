@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

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
                <!-- global button -->
                <div class="button-clear-filter">
                    <button class="btn btn-secondary" id="clear_button">Մաքրել բոլորը</button>
                </div>
                <!-- global button end -->
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="fa fa-filter"
                                            aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.created_user') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_and_time_date') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.organ') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.document_category') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.access_level') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.reg_number') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.reg_date') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worker_take_doc') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_agency') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_address') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.short_desc') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.related_year') }}<i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_inf') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.information_country') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.name_subject') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.title_document') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex-number">
                                        {{ __('content.file') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex-number">
                                        {{ __('content.short_video') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i>
                                    </th>

                                    <th></th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>

                                <tr>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
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
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
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
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
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
        <script src='{{ asset('assets/js/main/table.js') }}'></script>
        <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
    @endsection

@endsection
