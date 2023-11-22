@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.phone') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.phone') }}
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
                <div class="table-buttons-block">
                    <button class="button-table btn btn-light">{{ __('sidebar.bibliography') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.man') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.external_signs') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.phone') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.email') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.weapon') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.car') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.address') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.man_beann_country') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.objects_relation') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.action') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.event') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.signal') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.organization') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.keep_signal') }}</button>
                    <button class="button-table btn btn-light"> {{ __('sidebar.criminal_case') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.work_activity') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.control') }}</button>
                    <button class="button-table btn btn-light">{{ __('sidebar.mia_summary') }}</button>
                </div>
                <!-- global button -->
                <div class="button-clear-filter">
                    <button class="btn btn-secondary" id="clear_button">Մաքրել բոլորը</button>
                </div>
                <!-- global button end -->
                <x-form-error />
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
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
                                        {{ __('content.phone_number') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='number'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.nature_character') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='character'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.additional_data') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='more_data'></i>
                                    </th>
                                    {{-- <th></th> --}}
                                    <th></th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($data as $phone)
                                    <tr>
                                        {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        <td style=" text-align:center; align-items: center;"><i
                                                class="bi bi-pencil-square open-edit" title="խմբագրել"></i></td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye"
                                                data-id="{{ $phone->id }}" title="Դիտել"> </i>
                                        </td>
                                        <td>{{ $phone->id }}</td>
                                        <td>{{ $phone->number ?? '' }}</td>
                                        <td>


                                            @foreach ($phone->character as $character)
                                                {{ $character->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $phone->more_data ?? '' }}</td>
                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
                                        <td style="text-align: center"><i class="bi bi-plus-square open-add"
                                                title="Ավելացնել"></i></td>
                                        <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $phone->id }}"><i class="bi bi-trash3"></i>
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
        let ties = "{{ __('content.ties') }}"
        let parent_table_name = "{{ __('content.telephone') }}"

        let fieldName = 'phone_id'
        let relation = "{{ request()->relation }}"
        let main_route = "{{ request()->main_route }}"
        let model_id = "{{ request()->model_id }}"
    </script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
@endsection

@endsection
