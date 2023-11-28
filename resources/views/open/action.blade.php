@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')

    <x-breadcrumbs :title="__('sidebar.action')" />

    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">

                @if (request()->routeIs('optimization.*'))
                    @include('layouts.table_buttons')
                @endif

                <x-btn-create-clear-component route="action.create"/>

                {{--                <!-- global button end --> --}}
                {{--                <x-form-error /> --}}
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-section-name='open'
                            data-table-name={{ $page }} data-delete-url="/table-delete/{{ $page }}/">
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    <th></th>
                                    <th></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='id'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.content_materials_actions') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='material_content'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.qualification_fact') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='action_qualification'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.short_man') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='man_count'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.start_action_date') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='start_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.end_action_date') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='end_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.duration_action') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='duration'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.purpose_motive_reason') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='goal'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.terms_actions') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='terms'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.ensuing_effects') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='aftermath'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_information_actions') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='source'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.opened_dou') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_dou'></i></th>

                                    {{-- <th></th> --}}
                                    @if (isset(request()->main_route)|| $add)
                                        <th></th>
                                    @endif
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($data as $action)
                                    <tr>
                                        {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        <td style=" text-align:center; align-items: center;">
                                            <a href="{{ route('action.edit', $action->id) }}"><i
                                                    class="bi bi-pencil-square open-edit" title="խմբագրել"></i></a>
                                        </td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye"
                                                data-id="{{ $action->id }}" title="Դիտել"> </i>
                                        </td>
                                        <td>{{ $action->id }}</td>
                                        <td>
                                            @foreach ($action->material_content as $material)
                                                {{ $material->content }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($action->qualification as $qualification)
                                                {{ $qualification->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $action->man_count1->count() }}</td>
                                        <td>
                                            @if ($action->start_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($action->start_date));
                                                @endphp
                                            @endif

                                        </td>
                                        <td>
                                            @if ($action->end_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($action->end_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $action->duration ? $action->duration->name : '' }}</td>
                                        <td>{{ $action->goal ? $action->goal->name : '' }}</td>
                                        <td>{{ $action->terms ? $action->terms->name : '' }}</td>
                                        <td>{{ $action->aftermath ? $action->aftermath->name : '' }}</td>
                                        <td>{{ $action->source ?? '' }}</td>
                                        <td>{{ $action->opened_dou ?? '' }}</td>
                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
                                        @if (isset(request()->main_route))
                                            <td style="text-align: center">
                                                <a
                                                    href="{{ route('add_relation', ['main_route' => request()->main_route, 'model_id' => request()->model_id, 'relation' => request()->relation, 'fieldName' => 'action_id', 'id' => $action->id]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @endif
                                        <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $action->id }}"><i class="bi bi-trash3"></i>
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
        let parent_table_name = "{{ __('content.action') }}"
        let fieldName = 'action_id'
        let relation = "{{ request()->relation }}"
        let main_route = "{{ request()->main_route }}"
        let model_id = "{{ request()->model_id }}"
    </script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>

    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
@endsection

@endsection
