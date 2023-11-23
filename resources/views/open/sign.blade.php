@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')


    <x-breadcrumbs :title="__('sidebar.external_signs')" :crumbs="[['name' => __('sidebar.external_signs'), 'route' => 'open.page', 'route_param' => 'sign']]" />
    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                @if (request()->routeIs('optimization.*'))
                    @include('layouts.table_buttons')
                @endif

                <!-- global button -->
                {{--                <x-btn-create-clear-component route="action.create"/> --}}

                {{--                <!-- global button end --> --}}
                {{--                <x-form-error /> --}}
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-section-name="open"
                            data-table-name='{{ $page }}'>
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    <th></th>
                                    <th></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="id"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.signs') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="sign"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.time_fixation') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="fixed_date"></i>
                                    </th>

                                    {{-- <th></th> --}}
                                    <th></th>
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
                                        <td style=" text-align:center; align-items: center;">
                                             <a href="{{ route('sign.edit', $external_sign->id) }}">
                                            <i class="bi bi-pencil-square open-edit" title="խմբագրել"></i>
                                        </td>
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


                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
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
            @if (request()->routeIs('optimization.*'))
                let all_filter_icons = document.querySelectorAll('.filter-th i')

                all_filter_icons.forEach(element => {
                    element.style.display = 'none'
                });
            @endif

            let ties = "{{ __('content.ties') }}"
            let parent_table_name = "{{ __('content.signs') }}"

            let fieldName = 'sign_id'
            let relation = "{{ request()->relation }}"
            let main_route = "{{ request()->main_route }}"
            let model_id = "{{ request()->model_id }}"
        </script>
        <script src='{{ asset('assets/js/main/table.js') }}'></script>
        <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
        <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
    @endsection

@endsection
