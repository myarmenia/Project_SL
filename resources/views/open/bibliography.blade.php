@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
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
                <x-form-error/>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-section-name="open"
                            data-table-name='{{ $page }}'>
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    <th></th>
                                    <th></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="fa fa-filter"
                                            data-field-name="id" aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.created_user') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="user"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_and_time_date') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="created_at"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.organ') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="agency"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.document_category') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="doc_category"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.access_level') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="access_level"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.reg_number') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="reg_number"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.reg_date') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="reg_date"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worker_take_doc') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="worker_name"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_agency') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="source_agency"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_address') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="source_address"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.short_desc') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="short_desc"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.related_year') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="related_year"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_inf') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="source"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.information_country') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name="country"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.name_subject') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="theme"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.title_document') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="title"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex-number">
                                        {{ __('content.file') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="files_count1"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex-number">
                                        {{ __('content.short_video') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="video"></i>
                                    </th>
                                    {{-- <th></th> --}}
                                    @if(isset(request()->main_route))
                                        <th></th>
                                    @endif
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($data as $bibliography)
                                    <tr>
                                        {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        <td style="text-align:center; align-items: center;"><a
                                                href="{{ route('bibliography.edit', $bibliography->id) }}"><i
                                                    class="bi bi-pencil-square open-edit" title="խմբագրել"></i></a></td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye"
                                                data-id="{{ $bibliography->id }}" title="Դիտել"> </i>
                                        </td>
                                        <td>{{ $bibliography->id }}</td>
                                        <td>{{ $bibliography->users->username }}</td>
                                        <td>
                                            @if ($bibliography->created_at != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($bibliography->created_at));
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $bibliography->agency->name ?? '' }}</td>
                                        <td>{{ $bibliography->doc_category->name ?? '' }}</td>
                                        <td>{{ $bibliography->access_level->name ?? '' }}</td>
                                        <td>{{ $bibliography->reg_number ?? '' }}</td>
                                        <td>
                                            @if ($bibliography->reg_date != null)
                                                @php
                                                    echo date('d-m-Y', strtotime($bibliography->reg_date));
                                                @endphp
                                            @endif
                                        </td>
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
                                        <td>{{ $bibliography->files_count1->count() }}</td>
                                        <td>{{ $bibliography->video }}</td>
                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
                                                @if(isset(request()->main_route))
                                                <td style="text-align: center">
                                                    {{-- <a href="{{route('open.redirect', $address->id )}}"> --}}
                                                    <a href="{{ route('add_relation', ['main_route' => request()->main_route, 'model_id' => request()->model_id, 'relation' => request()->relation, 'fieldName' => 'bibliography_id', 'id' => $bibliography->id]) }}">
                                                    <i class="bi bi-plus-square open-add"
                                                    title="Ավելացնել"></i>
                                                    </a>
                                                </td>
                                            @elseif(Session::get('route') === 'operational-interest.create')
                                                <td style="text-align: center">
                                                    <a href="{{route('open.redirect',$bibliography->id )}}">
                                                        <i class="bi bi-plus-square open-add"
                                                           title="Ավելացնել"></i>
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
                <div id="myDiv">

                </div>
            </div>
    </section>
    <div>

    @section('js-scripts')
        <script>
            // let lang = "{{ app()->getLocale() }}"
            let ties = "{{ __('content.ties') }}"
            let parent_table_name = "{{ __('content.bibliography') }}"

            let fieldName = 'bibliography_id'
            let relation = "{{ request()->relation }}"
            let main_route = "{{request()->main_route}}"
            let model_id = "{{request()->model_id}}"


        </script>
        <script src='{{ asset('assets/js/main/table.js') }}'></script>
        <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
        <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
    @endsection

@endsection
