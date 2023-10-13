@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.action') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a >{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.action') }}
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
                                        {{ __('content.content_materials_actions') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.qualification_fact') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.short_man') }}<i class="fa fa-filter" aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.start_action_date') }}<i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.end_action_date') }}<i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.duration_action') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.purpose_motive_reason') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.terms_actions') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.ensuing_effects') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_information_actions') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.opened_dou') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>

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
                                    <td>269</td>
                                    <td>2649</td>
                                    <td>Garik</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td></td>
                                    <td></td>

                                </tr>

                                <tr>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td>26409</td>
                                    <td>knjnjnjnjnjn</td>
                                    <td>269</td>
                                    <td>2649</td>
                                    <td>Garik</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td></td>
                                    <td></td>

                                </tr>

                                <tr>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td>26409</td>
                                    <td>knjnjnjnjnjn</td>
                                    <td>269</td>
                                    <td>2649</td>
                                    <td>Garik</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
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
