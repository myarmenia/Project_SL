@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">

@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.organization') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.organization') }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                <!-- global button -->
                <div>
                    <a href="{{route('organization.create')}}" class="btn btn-secondary" id="clear_button">Ավելացնել նոր գրառում</a>
                </div>

                <div class="button-clear-filter">
                    <button class="btn btn-secondary" id="clear_button">Մաքրել բոլորը</button>
                </div>
                <!-- global button end -->
                <x-form-error/>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table"  data-section-name='open' data-table-name='{{ $page }}'>
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
                                    @if(isset(request()->main_route))
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
                                            <a href="{{route('organization.edit',$organization->id)}}">
                                                <i class="bi bi-pencil-square open-edit" title="խմբագրել"></i>
                                            </a></td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye" data-id="{{ $organization->id }}" title="Դիտել"> </i>
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

                                        {{-- @if(Session::get('route') === 'organization.create')
                                                <td style="text-align: center">
                                                    <a href="{{route('open.redirect',$organization->id )}}">
                                                    <i class="bi bi-plus-square open-add"
                                                    title="Ավելացնել"></i>
                                                    </a>
                                                </td>
                                        @endif --}}
                                        @if(isset(request()->main_route))
                                            <td style="text-align: center">
                                                <a href="{{ route('add_relation', ['main_route' => request()->main_route, 'model_id' => request()->model_id, 'relation' => request()->relation, 'fieldName' => 'organization_id', 'id' => $organization->id]) }}">
                                                <i class="bi bi-plus-square open-add"
                                                title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @elseif(in_array(Session::get('route'), ['organization.create','operational-interest-organization-man.create']))
                                                <td style="text-align: center">
                                                    <a href="{{route('open.redirect',$organization->id )}}">
                                                        <i class="bi bi-plus-square open-add"
                                                           title="Ավելացնել"></i>
                                                    </a>
                                                </td>
                                        @endif

                                        <td style="text-align: center"><i class="bi bi-trash3 open-delete"
                                                title="Ջնջել"></i>
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
    <div>

    @section('js-scripts')
    <script>
        let ties = "{{__('content.ties')}}"
        let parent_table_name = "{{__('content.organization')}}"

        let fieldName = 'organization_id'
        let relation = "{{ request()->relation }}"
        let main_route = "{{request()->main_route}}"
        let model_id = "{{request()->model_id}}"

    </script>
        <script src='{{ asset('assets/js/main/table.js') }}'></script>
        <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
        <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
    @endsection

@endsection
