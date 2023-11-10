@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.event') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.event') }}
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
                                        {{ __('content.qualification_event') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='event_qualification'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_security_date') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='date'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.ensuing_effects') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='aftermath'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.results_event') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='result'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.investigation_requested') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='agency'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_event') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='resource'></i>
                                    </th>

                                    <th></th>
                                    @if(Session::has('main_route'))
                                    <th></th>
                                    @endif
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($data as $event)
                                    <tr>
                                        {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        <td style=" text-align:center; align-items: center;"><i
                                                class="bi bi-pencil-square open-edit" title="խմբագրել"></i></td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye" data-id="{{ $event->id }}" title="Դիտել"> </i>
                                        </td>
                                        <td>{{ $event->id }}</td>
                                        <td>
                                            @foreach ($event->event_qualification as $qualification)
                                                {{ $qualification->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($event->date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($event->date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $event->aftermath->name ?? '' }}</td>
                                        <td>{{ $event->result ?? '' }}</td>
                                        <td>{{ $event->agency->name ?? '' }}</td>
                                        <td>{{ $event->resource->name ?? '' }}</td>
                                        <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td>
                                        @if(Session::has('main_route'))
                                            <td style="text-align: center">
                                                <a href="{{ route('add_relation', ['relation' => Session::get('relation'), 'fieldName' => 'event_id', 'id' => $event->id]) }}">
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
        let lang = "{{ app()->getLocale() }}"
        let ties = "{{__('content.ties')}}"
        let parent_table_name = "{{__('content.event')}}"

        let fieldName = 'event_id'
        let session_main_route = "{{ Session::has('main_route') }}"
        let relation = "{{ Session::get('relation') }}"
    </script>
        <script src='{{ asset('assets/js/main/table.js') }}'></script>
        <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
        <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
    @endsection

@endsection
