@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.weapon') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.weapon') }}
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
                <div class="button-clear-filter">
                    <button class="btn btn-secondary" id="clear_button">Մաքրել բոլորը</button>
                </div>
                <!-- global button end -->
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-section-name="open"
                            data-table-name="{{ $page }}">
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


                                    <th></th>
                                    @if (Session::has('main_route'))
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
                                        <td style=" text-align:center; align-items: center;"><i
                                                class="bi bi-pencil-square open-edit" title="խմբագրել"></i></td>
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

                                        <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td>
                                        @if (Session::has('main_route'))
                                            <td style="text-align: center">
                                                <a
                                                    href="{{ route('add_relation', ['relation' => Session::get('relation'), 'fieldName' => 'weapon_id', 'id' => $weapon->id]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @endif
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
            let lang = "{{ app()->getLocale() }}"
            let ties = "{{ __('content.ties') }}"
            let parent_table_name = "{{ __('content.weapon') }}"

            let fieldName = 'weapon_id'
            let session_main_route = "{{ Session::has('main_route') }}"
        </script>
        <script src='{{ asset('assets/js/main/table.js') }}'></script>
        <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
        <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
    @endsection

@endsection
