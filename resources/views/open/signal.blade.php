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
                <x-form-error />
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-section-name='open'
                            data-table-name='{{ $page }}' data-delete-url="/table-delete/{{ $page }}/">
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    <th></th>
                                    <th></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='id'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.reg_number_signal') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='reg_num'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.contents_information_signal') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='content'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.line_which_verified') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='check_line'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.check_status_charter') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='check_status'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.qualifications_signaling') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='signal_qualification'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_category') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='resource'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.checks_signal') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='agency_check_unit'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.department_checking') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='agency_check'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.unit_testing') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='agency_check_subunit'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.name_checking_signal') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='signal_checking_worker'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worker_post') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='worker_post'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_registration_division') }}<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='subunit_date'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.check_date') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='check_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.check_previously') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='signal_check_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.count') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='check_date_count'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_actual') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='end_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.amount_overdue') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='count_days'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.useful_capabilities') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='signal_used_resource'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.signal_results') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='signal_result'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.measures_taken') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='taken_measure'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.according_result_dow') }}<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='opened_dou'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.brought_signal') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_agency'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.department_brought') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_unit'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.unit_brought') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_subunit'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.name_operatives') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='worker'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worker_post') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='worker_post'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.keep_signal') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='keep_count'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.face') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='man_count'></i></th>

                                    {{-- <th></th> --}}
                                    @if (isset(request()->main_route))
                                        <th></th>
                                    @endif
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($data as $signal)
                                    <tr>

                                        <td style=" text-align:center; align-items: center;"><i
                                                class="bi bi-pencil-square open-edit" title="խմբագրել"></i></td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye" data-id=""
                                                title="Դիտել"> </i>
                                        </td>
                                        <td>{{ $signal->id }}</td>
                                        <td>{{ $signal->reg_num ?? '' }}</td>
                                        <td>{{ $signal->content ?? '' }}</td>
                                        <td>{{ $signal->check_line ?? '' }}</td>
                                        <td>{{ $signal->check_status ?? '' }}</td>
                                        <td>{{ $signal->signal_qualification ? $signal->signal_qualification->name : '' }}
                                        </td>
                                        <td>{{ $signal->resource ? $signal->resource->name : '' }}</td>
                                        <td>{{ $signal->agency_check_unit ? $signal->agency_check_unit->name : '' }}</td>
                                        <td>{{ $signal->agency_check ? $signal->agency_check->name : '' }}</td>
                                        <td>{{ $signal->agency_check_subunit ? $signal->agency_check_subunit->name : '' }}
                                        </td>
                                        <td>
                                            @foreach ($signal->signal_checking_worker as $checking_worker)
                                                {{ $checking_worker->worker }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($signal->worker_post as $worker_post)
                                                {{ $worker_post->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($signal->subunit_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($signal->subunit_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>
                                            @if ($signal->check_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($signal->check_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($signal->signal_check_date as $check_date)
                                                @if ($check_date->date != null)
                                                    @php
                                                        echo date('d-m-Y', strtotime($check_date->date));
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $signal->check_date_count->count() }}</td>
                                        <td>
                                            @if ($signal->end_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($signal->end_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $signal->count_number() }}</td>
                                        <td>
                                            @foreach ($signal->used_resource as $u_resource)
                                                {{ $u_resource->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $signal->signal_result ? $signal->signal_result->name : '' }}</td>
                                        <td>
                                            @foreach ($signal->has_taken_measure as $taken_measure)
                                                {{ $taken_measure->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $signal->opened_dou ?? '' }}</td>
                                        <td>{{ $signal->opened_agency ? $signal->opened_agency->name : '' }}</td>
                                        <td>{{ $signal->opened_unit ? $signal->opened_unit->name : '' }}</td>
                                        <td>{{ $signal->opened_subunit ? $signal->opened_subunit->name : '' }}</td>
                                        <td>
                                            @foreach ($signal->signal_worker as $signal_worker)
                                                {{ $signal_worker->worker }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($signal->signal_worker_post as $signal_worker_post)
                                                {{ $signal_worker_post->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $signal->keep_count->count() }}</td>
                                        <td>{{ $signal->man_count->count() }}</td>
                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
                                        @if (isset(request()->main_route))
                                            <td style="text-align: center">
                                                <a
                                                    href="{{ route('add_relation', ['main_route' => request()->main_route, 'model_id' => request()->model_id, 'relation' => request()->relation, 'fieldName' => 'signal_id', 'id' => $signal->id]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @endif
                                        <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $signal->id }}"><i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="countries-list"></div>
            </div>
        </div>
    </section>
    @include('components.delete-modal')
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
            let ties = "{{ __('content.ties') }}"
            let parent_table_name = "{{ __('content.signal') }}"

            let fieldName = 'signal_id'
            let relation = "{{ request()->relation }}"
            let main_route = "{{ request()->main_route }}"
            let model_id = "{{ request()->model_id }}"
        </script>
        <script src='{{ asset('assets/js/main/table.js') }}'></script>
        <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
        <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
    @endsection

@endsection
