@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.organization') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a >{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.organization') }}
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
                                        {{ __('content.name_organization') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.nation') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_formation') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>


                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.region_activity') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.category_organization') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">{{ __('content.number_worker') }}<i class="fa fa-filter"
                                        aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.attention') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.organization_dow') }} <i class="fa fa-filter" aria-hidden="true"></i>
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
