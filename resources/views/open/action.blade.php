@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.action') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.action') }}
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
                        <table id="resizeMe" class="person_table table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='id' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.content_materials_actions') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='material_content'
                                            data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.qualification_fact') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='action_qualification' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.short_man') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='man_count' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.start_action_date') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='start_date' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.end_action_date') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='end_date' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.duration_action') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='duration' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.purpose_motive_reason') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='goal' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.terms_actions') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='terms' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.ensuing_effects') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='aftermath' data-section-name='open'></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_information_actions') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name='source' data-section-name='open'></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.opened_dou') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name='opened_dou' data-section-name='open'></i></th>

                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($data as $action)
                                    <tr>
                                        <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td>
                                        <td style=" text-align:center; align-items: center;"><i
                                                class="bi bi-pencil-square open-edit" title="խմբագրել"></i></td>
                                        <td style="text-align: center"><a
                                                href="{{ route('open.page.restore', [$page, $action->id]) }}"
                                                title="վերականգնել"><i
                                                    class="bi bi-arrow-down-up open-regenerate"></i></a>
                                        </td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye" data-id="{{ $action->id }}" title="Դիտել"> </i>
                                        </td>
                                        <td>{{ $action->id }}</td>
                                        <td>
                                            @foreach ($action->material_content as $material)
                                                {{ $material->content }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($action->qualification as $qualification)
                                                {{ $qualification->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $action->man_count() }}</td>
                                        <td>
                                            @if ($action->start_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($action->start_date));
                                                @endphp
                                            @endif

                                        </td>
                                        <td>
                                            @if ($action->end_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($action->end_date));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $action->duraction->name ?? '' }}</td>
                                        <td>{{ $action->goal->name ?? '' }}</td>
                                        <td>{{ $action->terms->name ?? '' }}</td>
                                        <td>{{ $action->aftermath->name ?? '' }}</td>
                                        <td>{{ $action->source ?? '' }}</td>
                                        <td>{{ $action->opened_dou ?? '' }}</td>
                                        <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td>
                                        <td style="text-align: center"><i class="bi bi-plus-square open-add"
                                                title="Ավելացնել"></i></td>
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
        let ties = "{{__('content.ties')}}"
    </script>
        <script src='{{ asset('assets/js/main/table.js') }}'></script>
        <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>  
        <script src='{{ asset('assets/js/contact/contact.js') }}'></script>    
    @endsection

@endsection
