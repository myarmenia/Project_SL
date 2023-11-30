@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')

    <x-breadcrumbs :title="__('sidebar.keep_signal')" />

    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                @if (request()->routeIs('optimization.*'))
                    @include('layouts.table_buttons')
                @endif

                <!-- global button -->
                <x-btn-create-clear-component route="keepSignal.create" />

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
                                    {{-- <th></th> --}}
                                    @can($page . '-edit')
                                        <th></th>
                                    @endcan
                                    <th></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='id'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.management_signal') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='agency'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.department_checking_signal') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='unit_agency'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.unit_signal') }} <i class="fa fa-filter" aria-hidden="true"
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

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.start_checking_signal') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='start_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.end_checking_signal') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='end_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_transfer_unit') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='pass_date'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.unit_signal_transmitted') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='passed_subunit_agency'></i>
                                    </th>
                                    {{-- <th></th> --}}

                                    {{-- <th></th> --}}

                                    @can($page . '-delete')
                                        <th></th>
                                    @endcan
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($data as $k_signal)
                                    <tr>
                                        {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        @can($page . '-edit')
                                            <td style=" text-align:center; align-items: center;">
                                                <a href="{{ route('keep_signal.edit', $k_signal->id) }}">
                                                    <i class="bi bi-pencil-square open-edit" title="խմբագրել"></i>
                                                </a>
                                            </td>
                                        @endcan

                                        <td style="text-align: center">
                                            <i class="bi bi-eye open-eye" data-id="{{ $k_signal->id }}" title="Դիտել">
                                            </i>

                                        </td>
                                        <td>{{ $k_signal->id }}</td>
                                        <td>{{ $k_signal->agency->name ?? '' }}</td>
                                        <td>{{ $k_signal->unit_agency->name ?? '' }}</td>
                                        <td>{{ $k_signal->subunit_agency->name ?? '' }}</td>
                                        <td>
                                            @foreach ($k_signal->worker as $worker)
                                                {{ $worker->worker }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($k_signal->worker_post as $worker_post)
                                                {{ $worker_post->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($k_signal->start_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($k_signal->start_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>
                                            @if ($k_signal->end_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($k_signal->end_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>
                                            @if ($k_signal->pass_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($k_signal->pass_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $k_signal->passed_subunit_agency->name ?? '' }}</td>
                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}

                                        {{-- <td style="text-align: center"><i class="bi bi-plus-square open-add"
                                                title="Ավելացնել"></i></td> --}}

                                        @can($page . '-delete')
                                            <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $k_signal->id }}"><i class="bi bi-trash3"></i>
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
        let ties = "{{ __('content.ties') }}"
        let parent_table_name = "{{ __('content.keep_signal') }}"
        let fieldName = 'keep_signal_id'
        let relation = "{{ request()->relation }}"
        let main_route = "{{ request()->main_route }}"
        let model_id = "{{ request()->model_id }}"
    </script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
@endsection

@endsection
