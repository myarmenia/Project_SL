@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')

    <x-breadcrumbs :title="__('sidebar.organization')" />

    <!-- End Page Title -->
    <!-- add Perrson Table -->
    <section class="section">
        <div class="col">
            <div class="card">
                @if (request()->routeIs('optimization.*'))
                    @include('layouts.table_buttons')
                @endif

                <!-- global button -->
                <x-btn-create-clear-component :route="'organization.create'" />
                <!-- global button end -->
                <x-form-error />
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="count_block">
                        {{__('content.existent_table')}}
                                 <b>{{$total}}</b>
                        {{__('content.table_data')}}
                    </div>
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
                                        {{ __('content.name_organization') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='name'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.nation') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='country'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_formation') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='reg_date'></i>
                                    </th>


                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.region_activity') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='country_ate'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.category_organization') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='category'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.number_worker') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='employers_count'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.attention') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='attension'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.organization_dow') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_dou'></i>
                                    </th>

                                    {{-- <th></th> --}}
                                    @if (isset(request()->main_route))
                                        <th></th>
                                    @endif
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($data as $organization)
                                    <tr>
                                        {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        <td style=" text-align:center; align-items: center;">
                                            <a href="{{ route('organization.edit', $organization->id) }}">
                                                <i class="bi bi-pencil-square open-edit" title="խմբագրել"></i>
                                            </a>
                                        </td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye"
                                                data-id="{{ $organization->id }}" title="Դիտել"> </i>
                                        </td>
                                        <td>{{ $organization->id }}</td>
                                        <td>{{ $organization->name }}</td>
                                        <td>{{ $organization->country->name ?? '' }}</td>
                                        <td>
                                            @if ($organization->reg_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($organization->reg_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $organization->country_ate->name ?? '' }}</td>

                                        <td>{{ $organization->category->name ?? '' }}</td>
                                        <td>{{ $organization->employers_count ?? '' }}</td>
                                        <td>{{ $organization->attension ?? '' }}</td>
                                        <td>{{ $organization->opened_dou ?? '' }}</td>
                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}

                                        {{-- @if (Session::get('route') === 'organization.create')
                                                <td style="text-align: center">
                                                    <a href="{{route('open.redirect',$organization->id )}}">
                                                    <i class="bi bi-plus-square open-add"
                                                    title="Ավելացնել"></i>
                                                    </a>
                                                </td>
                                        @endif --}}
                                        @if(request()->model === 'bibliography')
                                            <td style="text-align: center">
                                                <a
                                                    href="{{ route('add_objects_relation', ['main_route' => request()->main_route, 'relation' => request()->relation, 'relation_id' => request()->id, 'model' => 'organization', 'id' => $organization->id]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @elseif (isset(request()->main_route) && isset(request()->relation))
                                            <td style="text-align: center">
                                                <a
                                                    href="{{ route('add_relation', ['main_route' => request()->main_route, 'model_id' => request()->model_id, 'relation' => request()->relation, 'fieldName' => 'organization_id', 'id' => $organization->id]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @elseif(isset(request()->main_route) && !isset(request()->relation))
                                            <td style="text-align: center">
                                                <a
                                                    href="{{ route('open.redirect', ['main_route' => request()->main_route, 'model' => 'organization', 'route_name' => request()->route_name, 'model_id' => $organization->id, 'route_id' => request()->model_id, 'redirect' => request()->redirect]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @endif


                                        <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $organization->id }}"><i class="bi bi-trash3"></i>
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

        let dinamic_field_name = "{{ __('content.field_name') }}"
        let dinamic_content = "{{ __('content.content') }}"
        let ties = "{{ __('content.ties') }}"
        let parent_table_name = "{{ __('content.organization') }}"
        let fieldName = 'organization_id'
        let relation = "{{ request()->relation }}"
        let main_route = "{{ request()->main_route }}"
        let model_id = "{{ request()->model_id }}"
    </script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
@endsection

@endsection
