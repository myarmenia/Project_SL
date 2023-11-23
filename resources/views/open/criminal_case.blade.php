@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')
    <x-breadcrumbs :title="__('sidebar.criminal_case')" :crumbs="[['name' => __('sidebar.criminal_case'), 'route' => 'open.page', 'route_param' => 'criminal_case']]" />

    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                @if (request()->routeIs('optimization.*'))
                    @include('layouts.table_buttons')
                @endif

                <!-- global button -->
                <x-btn-create-clear-component route="criminal_case.create" />
                <!-- global button end -->
                <x-form-error />
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-section-name='open'
                            data-table-name='{{ $page }}' data-delete-url="/table-delete/{{ $page }}/">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='id'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.number_case') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='number'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.criminal_proceedings_date') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='opened_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.criminal_code') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='artical'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.materials_management') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_agency'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.head_department') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_unit_agency'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.instituted_units') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='subunit_agency'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.name_operatives') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='worker'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worker_post') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='worker_post'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.nature_materials_paint') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='character'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.initiated_dow') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_dou'></i>
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
                                @foreach ($data as $c_case)
                                    <tr>
                                        <td style=" text-align:center; align-items: center;"><a
                                                href="{{ route('criminal_case.edit', $c_case->id) }}"><i
                                                    class="bi bi-pencil-square open-edit" title="խմբագրել"></i></a></td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye"
                                                data-id="{{ $c_case->id }}" title="Դիտել"> </i>
                                        </td>
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
                                        <td>{{ $c_case->man_count1->count() }}</td>
                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
                                        @if (isset(request()->main_route))
                                            <td style="text-align: center">
                                                <a
                                                    href="{{ route('add_relation', ['main_route' => request()->main_route, 'model_id' => request()->model_id, 'relation' => request()->relation, 'fieldName' => 'criminal_case_id', 'id' => $c_case->id]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @endif
                                        <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $c_case->id }}"><i class="bi bi-trash3"></i>
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

@section('js-scripts')
    <script>
        @if (request()->routeIs('optimization.*'))
            let all_filter_icons = document.querySelectorAll('.filter-th i')

            all_filter_icons.forEach(element => {
                element.style.display = 'none'
            });

            document.querySelector('#clear_button').style.display = 'none'
        @endif


        let ties = "{{ __('content.ties') }}"
        let parent_table_name = "{{ __('content.criminal') }}"

        let fieldName = 'event_id'
        let relation = "{{ request()->relation }}"
        let main_route = "{{ request()->main_route }}"
        let model_id = "{{ request()->model_id }}"
    </script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
@endsection

@endsection
