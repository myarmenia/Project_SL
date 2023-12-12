@extends('layouts.auth-app')

@section('style')

@endsection

@section('content')



    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                @if (request()->routeIs('optimization.*'))
                    @include('layouts.table_buttons')
                @endif

                <x-btn-create-clear-component route="controll.create" />
                <!-- global button end -->
                <x-form-error />
                <!-- global button end -->
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
                                    {{-- <th></th> --}}
                                    @can('control-edit')
                                        <th></th>
                                    @endcan
                                    <th></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name='id'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.unit') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='unit'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.document_category') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='doc_category'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.document_date') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='creation_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.reg_document') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='reg_num'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_reg') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='reg_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.director') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='snb_director'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.deputy_director') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='snb_subdirector'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_resolution') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='resolution_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.resolution') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='resolution'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.department_performer') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='act_unit'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.actor_name') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='actor_name'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.department_coauthors') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='sub_act_unit'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.actor_name') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='sub_actor_name'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.result_execution') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name='controll_result'></i>
                                    </th>
                                    {{-- <th></th> --}}
                                    {{-- <th></th> --}}
                                    @can('control-delete')
                                        <th></th>
                                    @endcan
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($data as $control)
                                    <tr>
                                        {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        @can('control-edit')
                                            <td style=" text-align:center; align-items: center;">
                                                <a href="{{ route('controll.edit', $control->id) }}">
                                                    <i class="bi bi-pencil-square open-edit" title="խմբագրել"></i>
                                                </a>
                                            </td>
                                        @endcan
                                        <td style="text-align: center"><i class="bi bi-eye open-eye"
                                                data-id="{{ $control->id }}" title="Դիտել"> </i></td>
                                        <td>{{ $control->id }}</td>
                                        <td>{{ $control->unit ? $control->unit->name : '' }}</td>
                                        <td>{{ $control->doc_category ? $control->doc_category->name : '' }}</td>
                                        <td>
                                            @if ($control->creation_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($control->creation_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $control->reg_num ?? '' }}</td>
                                        <td>
                                            @if ($control->reg_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($control->reg_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $control->snb_director ?? '' }}</td>
                                        <td>{{ $control->snb_subdirector ?? '' }}</td>
                                        <td>
                                            @if ($control->resolution_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($control->resolution_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $control->resolution ?? '' }}</td>
                                        <td>{{ $control->act_unit ? $control->act_unit->name : '' }}</td>
                                        <td>{{ $control->actor_name ?? '' }}</td>
                                        <td>{{ $control->sub_act_unit ? $control->sub_act_unit->name : '' }}</td>
                                        <td>{{ $control->sub_actor_name ?? '' }}</td>
                                        <td>{{ $control->controll_result ? $control->controll_result->name : '' }}</td>
                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
                                        {{-- <td style="text-align: center"><i class="bi bi-plus-square open-add"
                                                title="Ավելացնել"></i></td> --}}
                                        @can('control-delete')
                                            <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $control->id }}"><i class="bi bi-trash3"></i>
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
       
        let parent_table_name = "{{ __('content.control') }}"
        let fieldName = 'controll_id'
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
    </script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
@endsection

@endsection
