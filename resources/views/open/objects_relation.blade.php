@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')

    <x-breadcrumbs :title="__('sidebar.objects_relation')"/>

    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                <!-- global button -->
{{--                <x-btn-create-clear-component route="action.create"/>--}}

{{--                <!-- global button end -->--}}
{{--                <x-form-error />--}}
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-section-name='open'
                            data-table-name="{{ $page }}" data-delete-url="/table-delete/{{ $page }}/">
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    <th></th>
                                    <th></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='id'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.character_link') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='relation_type'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.first') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='first_object_id'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.second') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='second_object_id'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.first_object_type') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='first_object_type'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.second_object_type') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='second_obejct_type'></i></th>
                                    {{-- <th></th> --}}
                                    {{-- <th></th> --}}
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>

                                @if ($data->count() > 0)
                                    @foreach ($data as $relation)
                                        <tr>
                                            {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                            data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                            data-type="not_providing"><i class="bi bi-exclamation-circle open-exclamation"
                                                title="Տվյալների չտրամադրում"></i></span></td> --}}
                                            <td style=" text-align:center; align-items: center;"><i
                                                    class="bi bi-pencil-square open-edit" title="խմբագրել"></i></td>
                                            <td style="text-align: center"><i class="bi bi-eye open-eye"
                                                    data-id="{{ $relation->id }}" title="Դիտել"> </i></td>
                                            <td>{{ $relation->id }}</td>
                                            <td>{{ $relation->relation_type ? $relation->relation_type->name : '' }}</td>
                                            <td>{{ $relation->first_object_id ?? '' }}</td>
                                            <td>{{ $relation->second_object_id ?? '' }}</td>
                                            <td>{{ $relation->first_object_type ?? '' }}</td>
                                            <td>{{ $relation->second_obejct_type ?? '' }}</td>
                                            {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
                                            {{-- <td style="text-align: center"><i class="bi bi-plus-square open-add"
                                                title="Ավելացնել"></i></td> --}}
                                            <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $relation->id }}"><i class="bi bi-trash3"></i>
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
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
        let ties = "{{ __('content.ties') }}"
        let parent_table_name = "{{ __('content.objects_relation') }}"
    </script>

    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
@endsection

@endsection
