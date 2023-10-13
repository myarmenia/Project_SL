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
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                        {{ __('content.last_name') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                        {{ __('content.first_name') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.middle_name') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex">
                                        {{ __('content.date_of_birth_d') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex"
                                        title="Ծննդյան տարեթիվ(օր)">{{ __('content.date_of_birth_m') }} <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex" >
                                      {{ __('content.date_of_birth_y') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                     {{ __('content.first_name') }} {{ __('content.last_name') }} {{ __('content.middle_name') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                     {{ __('content.place_of_birth') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                     {{ __('content.place_of_birth_area') }}<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                     {{ __('content.place_of_birth_settlement') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.approximate_year') }}<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.passport_number') }}<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.gender') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.nationality') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.citizenship') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.knowledge_of_languages') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.attention') }} <i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.additional_information_person') }}  <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.worship') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                    {{ __('content.occupation') }}<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.country_carrying_out_search') }}<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.operational_category_person') }}<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date"
                                        >{{ __('content.declared_wanted_list_with') }}<i class="fa fa-filter"
                                            aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date"
                                       >{{ __('content.home_monitoring_start') }}<i class="fa fa-filter"
                                            aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date"
                                    >{{ __('content.end_monitoring_start') }}<i class="fa fa-filter"
                                            aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.education') }}<i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.party') }}<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                    {{ __('content.alias') }}<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                     {{ __('content.face_opened') }}<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" >
                                    {{ __('content.source_inf') }}<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex">
                                    {{ __('content.short_photo') }}<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal" data-type="not_providing">Տվյալների չտրամադրում</span></td>
                                    <td style="text-align: center"><i class="bi bi-eye open-eye"></i></td>
                                    <td style="text-align: center"><i class="bi bi-pencil-square open-edit"></i></td>
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
        <!-- add Person table end -->

        <!-- large modal blog -->
        <div class="modal fade" id="announcement_modal" tabindex="-1" aria-labelledby="exampleModalLgLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="exampleModalLgLabel">Ավելացնել նոր գրառում</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="large-modalBlock">
                            <div class="mb-3 announcement-input-block">
                                <label for="start_of_announcement" class="form-label">Հայտարարման սկիզբ</label>
                                <input style="position: relative;" type="date" class="form-control"
                                    id="start_of_announcement">
                            </div>
                            <div class="mb-3 announcement-input-block">
                                <label for="end_of_announcement" class="form-label">Հայտարարման ավարտ</label>
                                <input style="position: relative;" type="date" class="form-control"
                                    id="end_of_announcement">
                            </div>
                            <div class="mb-3 announcement-input-block">
                                <label for="exampleFormControlTextarea1" class="form-label">Նկարագրություն</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                        </div>
                        <div class="modal-button">
                            <button class='btn btn-primary my-class-sub' data-bs-dismiss="modal">Ավելացնել</button>
                        </div>

                    </div>
                </div>
            </div>



        @section('js-scripts')
            <script src='{{ asset('assets/js/main/table.js') }}'></script>
            <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
        @endsection

    @endsection
