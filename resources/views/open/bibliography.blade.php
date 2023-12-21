@extends('layouts.auth-app')

@section('style')

@endsection

@section('content')



    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                @if (request()->routeIs('optimization.*'))
                    @include('layouts.table_buttons')
                @endif
                <!-- global button -->
                <x-btn-create-clear-component route="bibliography.create" />
                <!-- global button end -->
                <x-form-error />
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="count_block">
                        {{ __('content.existent_table') }}
                        <b>{{ $total }}</b>
                        {{ __('content.table_data') }}
                    </div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-section-name="open"
                            data-table-name='{{ $page }}' data-delete-url="/table-delete/{{ $page }}/">
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    @can($page . '-edit')
                                        <th></th>
                                    @endcan
                                    <th></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id<i class="bi bi-funnel-fill"
                                            data-field-name="id" aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.created_user') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="user"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_and_time_date') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="created_at"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.organ') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="agency"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.document_category') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="doc_category"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.access_level') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="access_level"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.reg_number') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="reg_number"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.reg_date') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="reg_date"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worker_take_doc') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="worker_name"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_agency') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="source_agency"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_address') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="source_address"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.short_desc') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="short_desc"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        {{ __('content.related_year') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="related_year"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_inf') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="source"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.information_country') }} <i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="country"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.name_subject') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="theme"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.title_document') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="title"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex-number">
                                        {{ __('content.file') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="files_count1"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex-number">
                                        {{ __('content.short_video') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="video"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        ֆայլի անվանում <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="files_real_name"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        ֆայլի մեկնաբանւոթյուն <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="files_comment"></i>
                                    </th>
                                    {{-- <th></th> --}}
                                    @if (isset(request()->main_route))
                                        <th></th>
                                    @endif
                                    @can($page . '-delete')
                                        <th></th>
                                    @endcan
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($data as $bibliography)
                                    {{-- @dd($data) --}}
                                    <tr>
                                        {{-- <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        @can($page . '-edit')
                                            <td style=" text-align:center; align-items: center;">
                                                <a href="{{ route('bibliography.edit', $bibliography->id) }}">
                                                    <i class="bi bi-pencil-square open-edit" title="խմբագրել"></i>
                                                </a>
                                            </td>
                                        @endcan
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
                                        <td>
                                            @foreach ($bibliography->files_real_name as $files_real)
                                                {{ $files_real->real_name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($bibliography->files_real_name as $files_real)
                                                {{ $files_real->file_comment }}
                                            @endforeach
                                        </td>
                                        {{-- <td style="text-align: center"><i class="bi bi-file-word open-word"
                                                title="Word ֆայլ"></i></td> --}}
                                        @if (isset(request()->main_route))
                                            <td style="text-align: center">
                                                {{-- <a href="{{route('open.redirect', $address->id )}}"> --}}
                                                <a
                                                    href="{{ route('add_relation', ['main_route' => request()->main_route, 'model_id' => request()->model_id, 'relation' => request()->relation, 'fieldName' => 'bibliography_id', 'id' => $bibliography->id]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @elseif(Session::get('route') === 'objectsRelation.create')
                                            <td style="text-align: center">
                                                <a href="{{ route('open.redirect', $bibliography->id) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @endif
                                        @can($page . '-delete')
                                            <td style="text-align: center"><button class="btn_close_modal my-delete-item"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $bibliography->id }}"><i class="bi bi-trash3"></i>
                                                </button>
                                            </td>
                                        @endcan

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

        let allow_change = ''
        let allow_delete = ''

        @can($page . '-edit')
            allow_change = true
        @else
            allow_change = false
        @endcan

        @can($page . '-delete')
            allow_delete = true
        @else
            allow_delete = false
        @endcan

        // let lang = "{{ app()->getLocale() }}"
        let dinamic_field_name = "{{ __('content.field_name') }}"
        let dinamic_content = "{{ __('content.content') }}"
        
        let parent_table_name = "{{ __('content.bibliography') }}"
        let fieldName = 'bibliography_id'
        let relation = "{{ request()->relation }}"
        let main_route = "{{ request()->main_route }}"
        let model_id = "{{ request()->model_id }}"
        // filter translate //
        let equal = "{{ __('content.equal') }}" // havasar e
        let not_equal = "{{ __('content.not_equal') }}" // havasar che
        let more = "{{ __('content.more') }}" // mec e
        let more_equal = "{{ __('content.more_equal') }}" // mece kam havasar
        let less = "{{ __('content.less') }}" // poqre
        let less_equal = "{{ __('content.less_equal') }}" // poqre kam havasar

        let contains = "{{ __('content.contains') }}" // parunakum e
        let start = "{{ __('content.start') }}" // sksvum e
        let search_as = "{{ __('content.search_as') }} " // pntrel nayev

        let seek = "{{ __('content.seek') }}" // pntrel
        let clean = "{{ __('content.clean') }}" // maqrel
        let and_search = "{{ __('content.and') }}" // ev
        let or_search = "{{ __('content.or') }}" // kam
        // filter translate //
        let bibliography_id = null

        @if (isset($bibliography_id))
            bibliography_id = "{{ $bibliography_id }}"
        @endif
    </script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
@endsection

@endsection
