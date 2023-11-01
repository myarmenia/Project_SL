@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

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
                                    {{-- <th></th> --}}
                                    <th></th>
                                    <th></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='id' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.reg_number_signal') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='reg_num' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.contents_information_signal') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='content' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.line_which_verified') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='check_line' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.check_status_charter') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='check_status' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.qualifications_signaling') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='signal_qualification'
                                            data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_category') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='resource' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.checks_signal') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='check_unit' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.department_checking') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='check_agency' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.unit_testing') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='check_subunit' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.name_checking_signal') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='checking_worker' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worker_post') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='checking_worker_post' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_registration_division') }}<i class="fa fa-filter"
                                            aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.check_date') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='subunit_date' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.check_previously') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='check_date' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.count') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='check_date_id' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_actual') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='check_date_count' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.amount_overdue') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='end_date' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.useful_capabilities') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='count_days' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.signal_results') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='signal_used_resource' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.measures_taken') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='signal_result' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.according_result_dow') }}<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='taken_measure'
                                            data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.brought_signal') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_dou' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.department_brought') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_agenncy' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.unit_brought') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_unit' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.name_operatives') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_subunit' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worker_post') }}<i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.keep_signal') }}<i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.face') }}<i class="fa fa-filter" aria-hidden="true"></i></th>

                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>

                                <tr>
                                    {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                            data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                            data-type="not_providing"><i class="bi bi-exclamation-circle open-exclamation"
                                                title="Տվյալների չտրամադրում"></i></span></td> --}}
                                    <td style=" text-align:center; align-items: center;"><i
                                            class="bi bi-pencil-square open-edit" title="խմբագրել"></i></td>
                                    <td style="text-align: center"><i class="bi bi-eye open-eye" data-id="" title="Դիտել"> </i>
                                    </td>
                                    <td>5296</td>
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
                                    <td style="text-align: center"><i class="bi bi-file-word open-word"
                                            title="Word ֆայլ"></i></td>
                                    <td style="text-align: center"><i class="bi bi-plus-square open-add"
                                            title="Ավելացնել"></i></td>
                                    <td style="text-align: center"><i class="bi bi-trash3 open-delete"
                                            title="Ջնջել"></i></td>
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
        <script>
            let lang = "{{ app()->getLocale() }}"
            let ties = "{{__('content.ties')}}"
            let parent_table_name = "{{__('content.signal')}}"
        </script>
            <script src='{{ asset('assets/js/main/table.js') }}'></script>
            <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
            <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
        @endsection

    @endsection
