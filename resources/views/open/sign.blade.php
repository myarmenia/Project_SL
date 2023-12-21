@extends('layouts.auth-app')


@section('content')

    <section class="section">
        <div class="col">
            <div class="card">
                @if (request()->routeIs('optimization.*'))
                    @include('layouts.table_buttons')
                @endif
                <!-- global button -->
                <x-btn-create-clear-component route="man.sign.create" />
                <!-- global button end -->
                <x-form-error />
                <!-- global button -->
                {{--                <x-btn-create-clear-component route="action.create"/> --}}

                {{--                <!-- global button end --> --}}
                {{--                <x-form-error /> --}}
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="count_block">
                        {{ __('content.existent_table') }}
                        <b>{{ $total }}</b>
                        {{ __('content.table_data') }}
                    </div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-section-name="open"
                            data-table-name='{{ $page }}' data-delete-url="/table-delete/external_sign_has_sign/">
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    @can('external_signs-edit')
                                        <th></th>
                                    @endcan
                                    <th></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id
                                        <i class="bi bi-funnel-fill" aria-hidden="true" data-field-name="id"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.signs') }}
                                        <i class="bi bi-funnel-fill" aria-hidden="true" data-field-name="sign"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.time_fixation') }}
                                        <i class="bi bi-funnel-fill" aria-hidden="true" data-field-name="fixed_date"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_and_time_date') }}<i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="created_at" data-section-name="open"></i>
                                    </th>

                                    @can('external_signs-delete')
                                        <th></th>
                                    @endcan
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($data as $external_sign)
                                    <tr>

                                        {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        @can('external_signs-edit')
                                            <td style=" text-align:center; align-items: center;">
                                                <a href="{{ route('sign.edit', $external_sign->id) }}">
                                                    <i class="bi bi-pencil-square open-edit" title="խմբագրել"></i>
                                                </a>
                                            </td>
                                        @endcan
                                        <td style="text-align: center"><i class="bi bi-eye open-eye"
                                                data-id="{{ $external_sign->id }}" title="Դիտել"> </i>
                                            {{-- </a> --}}
                                        </td>

                                        <td>{{ $external_sign->id }}</td>
                                        <td>{{ $external_sign->sign->name ?? '' }}</td>
                                        <td>
                                            @if ($external_sign->fixed_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($external_sign->fixed_date));
                                                @endphp
                                            @endif
                                        </td>

                                        <td>
                                            @if ($external_sign->created_at != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($external_sign->created_at));
                                                @endphp
                                            @endif
                                        </td>

                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
                                        @can('external_signs-delete')
                                            <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $external_sign->id }}"><i class="bi bi-trash3"></i>
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
    <div>

        @include('components.delete-modal')

    @section('js-scripts')
        <script>
            @if (request()->routeIs('optimization.*'))
                let all_filter_icons = document.querySelectorAll('.filter-th i')

                all_filter_icons.forEach(element => {
                    element.style.display = 'none'
                });


                document.querySelectorAll('#clear_button').style.display = 'none'
            @endif

            let allow_change = ''
            let allow_delete = ''

            @can('external_signs-edit')
                allow_change = true
            @else
                allow_change = false
            @endcan

            @can('external_signs-delete')
                allow_delete = true
            @else
                allow_delete = false
            @endcan

            let dinamic_field_name = "{{ __('content.field_name') }}"
            let dinamic_content = "{{ __('content.content') }}"

            let parent_table_name = "{{ __('content.signs') }}"
            let fieldName = 'sign_id'
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
            let contains = "{{ __('content.contains') }}" // parunakum e
            let start = "{{ __('content.start') }}" // sksvum e
            let search_as = "{{ __('content.search_as') }} " // pntrel nayev
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
