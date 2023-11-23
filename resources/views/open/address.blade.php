@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')

    <x-breadcrumbs :title="__('sidebar.address')" :crumbs="[['name' => __('sidebar.address'), 'route' => 'open.page', 'route_param' => 'address']]" />


    <!-- End Page Title -->

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
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="id"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.country_ate') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="country_ate"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.region') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="region"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.locality') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="locality"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.street') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="street"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.track') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="track"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.home_num') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="home_num"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.housing_num') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="housing_num"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.apt_num') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="apt_num"></i>
                                    </th>

                                    {{-- <th></th> --}}
                                    @if (isset(request()->main_route))
                                        <th></th>
                                    @endif
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($data as $address)
                                    <tr>
                                        {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        <td style=" text-align:center; align-items: center;"><i
                                                class="bi bi-pencil-square open-edit" title="խմբագրել"></i></td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye"
                                                data-id="{{ $address->id }}" title="Դիտել"> </i>
                                        </td>

                                        <td>{{ $address->id }}</td>
                                        <td>{{ $address->country_ate ? $address->country_ate->name : '' }}</td>
                                        <td>{{ $address->region ? $address->region->name : '' }}</td>
                                        <td>{{ $address->locality ? $address->locality->name : '' }}</td>
                                        <td>{{ $address->street ? $address->street->name : '' }}</td>
                                        <td>{{ $address->track ?? '' }}</td>
                                        <td>{{ $address->home_num ?? '' }}</td>
                                        <td>{{ $address->housing_num ?? '' }}</td>
                                        <td>{{ $address->apt_num ?? '' }}</td>

                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
                                        {{-- <td style="text-align: center"><i class="bi bi-plus-square open-add"
                                                title="Ավելացնել"></i></td> --}}

                                        @if (isset(request()->main_route))
                                            <td style="text-align: center">
                                                <a
                                                    href="{{ route('add_relation', ['main_route' => request()->main_route, 'model_id' => request()->model_id, 'relation' => request()->relation, 'fieldName' => 'address_id', 'id' => $address->id]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @endif
                                        <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $address->id }}"><i class="bi bi-trash3"></i>
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
        @endif

        let ties = "{{ __('content.ties') }}"
        let parent_table_name = "{{ __('content.address') }}"

        let fieldName = 'address_id'
        let relation = "{{ request()->relation }}"
        let main_route = "{{ request()->main_route }}"
        let model_id = "{{ request()->model_id }}"
    </script>

    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
@endsection

@endsection
