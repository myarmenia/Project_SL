@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.bibliography') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.bibliography') }}
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
                                            data-field-name="id" data-section-name="open" aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.created_user') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="user_name" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_and_time_date') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="created_at" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.organ') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="from_agency_name" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.document_category') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="doc_category" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.access_level') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="access_level" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.reg_number') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="reg_number" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.reg_date') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="reg_date" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worker_take_doc') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="worker_name" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_agency') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="source_agency_name" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_address') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="source_address" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.short_desc') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="short_desc" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.related_year') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="related_year" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_inf') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="source" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.information_country') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name="country" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.name_subject') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="theme" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.title_document') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="title" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex-number">
                                        {{ __('content.file') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="file_count" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex-number">
                                        {{ __('content.short_video') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="video" data-section-name="open"></i>
                                    </th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($data as $bibliography)
                                    <tr>
                                        <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td>
                                        <td style="text-align:center; align-items: center;"><a href="{{ route('bibliography.edit', $bibliography->id) }}"><i
                                                    class="bi bi-pencil-square open-edit" title="խմբագրել"></i></a></td>
                                        <td style="text-align: center"><a
                                                href="{{ route('open.page.restore', [$page, $bibliography->id]) }}"
                                                title="վերականգնել"><i
                                                    class="bi bi-arrow-down-up open-regenerate"></i></a></td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye" data-id="{{ $bibliography->id }}" title="Դիտել"> </i>
                                        </td>
                                        <td>{{ $bibliography->id }}</td>
                                        <td>{{ $bibliography->users->username }}</td>
                                        <td>
                                            @php
                                                echo date('d-m-Y', strtotime($bibliography->created_at));
                                            @endphp
                                        </td>
                                        <td>{{ $bibliography->agency->name ?? '' }}</td>
                                        <td>{{ $bibliography->doc_category->name ?? '' }}</td>
                                        <td>{{ $bibliography->access_level->name ?? '' }}</td>
                                        <td>{{ $bibliography->reg_number ?? '' }}</td>
                                        <td>{{ $bibliography->reg_date ?? '' }}</td>
                                        <td>{{ $bibliography->worker_name ?? '' }}</td>
                                        <td>{{ $bibliography->source_agency->name ?? '' }}</td>
                                        <td>{{ $bibliography->source_address ?? '' }}</td>
                                        <td>{{ $bibliography->short_desc ?? '' }}</td>
                                        <td>{{ $bibliography->related_year }}</td>
                                        <td>{{ $bibliography->source }}</td>
                                        <td>
                                            @foreach ($bibliography->country as $country)
                                                {{ $country->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $bibliography->theme }}</td>
                                        <td>{{ $bibliography->title }}</td>
                                        <td>{{ $bibliography->files_count() }}</td>
                                        <td>{{ $bibliography->video }}</td>
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
                <div id="myDiv">
                  
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
