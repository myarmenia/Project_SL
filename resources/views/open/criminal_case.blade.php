@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.criminal_case') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.criminal_case') }}
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
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='id' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.number_case') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='number' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.criminal_proceedings_date') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='opened_date' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.criminal_code') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='artical' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.materials_management') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_agency' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.head_department') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='unit' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.instituted_units') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='subunit' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.name_operatives') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='worker' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worker_post') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='worker_post' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.nature_materials_paint') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='character' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.initiated_dow') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_dou' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.face') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='man_count' data-section-name='open'></i></th>

                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($data as $c_case)
                                    <tr>
                                        <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td>
                                        <td style=" text-align:center; align-items: center;"><i
                                                class="bi bi-pencil-square open-edit" title="խմբագրել"></i></td>
                                        <td style="text-align: center"><a
                                                href="{{ route('open.page.restore', [$page, 1]) }}"
                                                title="վերականգնել"><i
                                                    class="bi bi-arrow-down-up open-regenerate"></i></a>
                                        </td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye" data-id="{{ $c_case->id }}" title="Դիտել"> </i>
                                        </td>
                                        <td>{{ $c_case->id }}</td>
                                        <td>{{ $c_case->number ?? '' }}</td>
                                        <td>
                                            @if ($c_case->opened_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($c_case->opened_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $c_case->artical ?? '' }}</td>
                                        <td>{{ $c_case->opened_agency->name ?? '' }}</td>
                                        <td>{{ $c_case->opened_unit_agency->name ?? '' }}</td>
                                        <td>{{ $c_case->subunit_agency->name ?? '' }}</td>
                                        <td>
                                            @foreach ($c_case->worker as $worker)
                                                {{ $worker->worker }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($c_case->worker_post as $worker_post)
                                                {{ $worker_post->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $c_case->character ?? '' }}</td>
                                        <td>{{ $c_case->opened_dou ?? '' }}</td>
                                        <td>{{ $c_case->man_count() }}</td>
                                        <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td>
                                        <td style="text-align: center"><i class="bi bi-plus-square open-add"
                                                title="Ավելացնել"></i></td>
                                        <td style="text-align: center"><i class="bi bi-trash3 open-delete"
                                                title="Ջնջել"></i></td>
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
    <div>

    @section('js-scripts')
    <script>
        let lang = "{{ app()->getLocale() }}"
        let ties = "{{__('content.ties')}}"
    </script>
        <script src='{{ asset('assets/js/main/table.js') }}'></script>
        <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
        <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
    @endsection

@endsection
