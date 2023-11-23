@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')
    <x-breadcrumbs :title="__('sidebar.control')" :crumbs="[['name' => __('sidebar.control'), 'route' => 'open.page', 'route_param' => 'controll']]" />

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
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-section-name='open'
                            data-table-name='{{ $page }}' data-delete-url="/table-delete/{{ $page }}/">
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    <th></th>
                                    <th></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='id'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.unit') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='unit'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.document_category') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='doc_category'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.document_date') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='creation_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.reg_document') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='reg_num'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_reg') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='reg_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.director') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='snb_director'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.deputy_director') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='snb_subdirector'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_resolution') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='resolution_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.resolution') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='resolution'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.department_performer') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='act_unit'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.actor_name') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='actor_name'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.department_coauthors') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='sub_act_unit'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.actor_name') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='sub_actor_name'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.result_execution') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='controll_result'></i>
                                    </th>
                                    {{-- <th></th> --}}
                                    {{-- <th></th> --}}
                                    <th></th>
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
                                        <td style=" text-align:center; align-items: center;"><a
                                                href="{{ route('controll.edit', $control->id) }}"><i
                                                    class="bi bi-pencil-square open-edit" title="խմբագրել"></i></a< /td>
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
                                        <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $control->id }}"><i class="bi bi-trash3"></i>
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
        let parent_table_name = "{{ __('content.control') }}"

        let fieldName = 'controll_id'
        let relation = "{{ request()->relation }}"
        let main_route = "{{ request()->main_route }}"
        let model_id = "{{ request()->model_id }}"
    </script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
@endsection

@endsection
