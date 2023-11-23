@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')


    <x-breadcrumbs :title="__('sidebar.man_beann_country')" />

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
                            data-table-name='{{ $page }}' data-delete-url="/table-delete/{{ $page }}/">
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    <th></th>
                                    <th></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name="id"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.purpose_visit') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="goal"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.country_ate') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="country_ate"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.entry_date') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="entry_date"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.exit_date') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="exit_date"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.region') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="region"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.locality') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="locality"></i></th>


                                    {{-- <th></th> --}}
                                    {{-- <th></th> --}}
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($data as $b_country)
                                    <tr>
                                        {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        <td style=" text-align:center; align-items: center;"><i
                                                class="bi bi-pencil-square open-edit" title="խմբագրել"></i></td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye"
                                                data-id="{{ $b_country->id }}" title="Դիտել"> </i>

                                        </td>
                                        <td>{{ $b_country->id }}</td>
                                        <td>{{ $b_country->goal ? $b_country->goal->name : '' }}</td>
                                        <td>{{ $b_country->country_ate ? $b_country->country_ate->name : '' }}</td>
                                        <td>
                                            @if ($b_country->entry_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($b_country->entry_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>
                                            @if ($b_country->exit_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($b_country->exit_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $b_country->region ? $b_country->region->name : '' }}</td>
                                        <td>{{ $b_country->locality ? $b_country->locality->name : '' }}</td>
                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
                                        {{-- <td style="text-align: center"><i class="bi bi-plus-square open-add"
                                                title="Ավելացնել"></i></td> --}}
                                        <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $b_country->id }}"><i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
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
        let parent_table_name = "{{ __('content.man_bean_country') }}"
    </script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
@endsection

@endsection
