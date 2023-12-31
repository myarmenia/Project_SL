@extends('layouts.auth-app')

@section('content')

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
                    <div class="count_block">
                        {{ __('content.existent_table') }}
                        <b>{{ $total }}</b>
                        {{ __('content.table_data') }}
                    </div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-section-name='open'
                            data-table-name='{{ $page }}' data-delete-url="/table-delete/{{ $page }}/">
                            <thead>
                                <tr>
                                    @can($page . '-edit')
                                        <th></th>
                                    @endcan
                                    <th></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name='id'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.number_case') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='number'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.criminal_proceedings_date') }} <i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name='opened_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.criminal_code') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='artical'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.materials_management') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='opened_agency'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.head_department') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='opened_unit_agency'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.instituted_units') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='subunit_agency'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.name_operatives') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='worker'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worker_post') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='worker_post'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.nature_materials_paint') }} <i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name='character'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.initiated_dow') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='opened_dou'></i>
                                    </th>

                                    {{-- <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.face') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='man_count'></i></th> --}}

                                    {{-- <th></th> --}}
                                    @if (isset(request()->main_route))
                                        <th></th>
                                    @endif
                                    @can($page . '-delete')
                                        <th></th>
                                    @endcan
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($data as $c_case)
                                    <tr>
                                        @can($page . '-edit')
                                            <td style=" text-align:center; align-items: center;">
                                                <a href="{{ route('criminal_case.edit', $c_case->id) }}">
                                                    <i class="bi bi-pencil-square open-edit" title="խմբագրել"></i>
                                                </a>
                                            </td>
                                        @endcan
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
                                        {{-- <td>{{ $c_case->man_count1->count() }}</td> --}}
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
                                        @can($page . '-delete')
                                            <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $c_case->id }}"><i class="bi bi-trash3"></i>
                                                </button>
                                            </td>
                                        @endcan
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

        let allow_change = ''
        let allow_delete = ''

        @can($page . '-edit')
            allow_change = true
        @else
            allow_change = false
        @endcan

        @can($page . '-delete')
            allow_delete = true
        @else
            allow_delete = false
        @endcan


        let dinamic_field_name = "{{ __('content.field_name') }}"
        let dinamic_content = "{{ __('content.content') }}"
       
        let parent_table_name = "{{ __('content.criminal') }}"
        let fieldName = 'event_id'
        let relation = "{{ request()->relation }}"
        let main_route = "{{ request()->main_route }}"
        let model_id = "{{ request()->model_id }}"
        // filter translate //
        let equal = "{{ __('content.equal') }}" // havasar e
        let not_equal = "{{ __('content.not_equal') }}" // havasar che
        let more = "{{ __('content.more') }}" // mec e
        let more_equal = "{{ __('content.more_equal') }}" // mece kam havasar
        let less = "{{ __('content.less') }}" // poqre
        let less_equal = "{{ __('content.less_equal') }}" // poqre kam havasar
        let contains  = "{{ __('content.contains') }}" // parunakum e
        let start = "{{ __('content.start') }}" // sksvum e
        let search_as = "{{ __('content.search_as') }} "// pntrel nayev
        let seek = "{{ __('content.seek') }}" // pntrel
        let clean = "{{ __('content.clean') }}" // maqrel
        let and_search = "{{ __('content.and') }}" // ev
        let or_search = "{{ __('content.or') }}" // kam
        // filter translate //
        let bibliography_id = null

        @if (isset($bibliography_id))
            bibliography_id = "{{ $bibliography_id }}"
        @endif
    </script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
@endsection

@endsection
