@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')

    <x-breadcrumbs :title="__('sidebar.weapon')" />


    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                @if (request()->routeIs('optimization.*'))
                    @include('layouts.table_buttons')
                @endif

                <!-- global button -->
                <x-btn-create-clear-component route="weapon.create" />

                {{--                <!-- global button end --> --}}
                {{--                <x-form-error /> --}}
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-section-name="open"
                            data-table-name="{{ $page }}" data-delete-url="/table-delete/{{ $page }}/">
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    <th></th>
                                    <th></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="id"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.weapon_cat') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="category"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.view') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="view"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.type') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="type"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.mark') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="model"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.account_number') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="reg_num"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">{{ __('content.count') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="count"></i>
                                    </th>


                                    {{-- <th></th> --}}
                                    @if (isset(request()->main_route))
                                        <th></th>
                                    @endif
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($data as $weapon)
                                    <tr>
                                        {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        <td style=" text-align:center; align-items: center;">
                                            <a href="{{ route('weapon.edit', $weapon->id) }}">
                                                <i class="bi bi-pencil-square open-edit" title="խմբագրել"></i>
                                            </a>
                                        </td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye"
                                                data-id="{{ $weapon->id }}" title="Դիտել"> </i>

                                        </td>

                                        <td>{{ $weapon->id }}</td>
                                        <td>{{ $weapon->category ?? '' }}</td>
                                        <td>{{ $weapon->view ?? '' }}</td>
                                        <td>{{ $weapon->type ?? '' }}</td>
                                        <td>{{ $weapon->model ?? '' }}</td>
                                        <td>{{ $weapon->reg_num ?? '' }}</td>
                                        <td>{{ $weapon->count ?? '' }}</td>

                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
                                        @if (isset(request()->main_route))
                                            <td style="text-align: center">
                                                <a
                                                    href="{{ route('add_relation', ['main_route' => request()->main_route, 'model_id' => request()->model_id, 'relation' => request()->relation, 'fieldName' => 'weapon_id', 'id' => $weapon->id]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @endif
                                        <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $weapon->id }}"><i class="bi bi-trash3"></i>
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
        let parent_table_name = "{{ __('content.weapon') }}"

        let fieldName = 'weapon_id'
        let relation = "{{ request()->relation }}"
        let main_route = "{{ request()->main_route }}"
        let model_id = "{{ request()->model_id }}"
    </script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
@endsection

@endsection
