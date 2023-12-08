@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
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
                <x-btn-create-clear-component route="man.create" />
                <div class="man-search-inputs-block">
                    <div class="man-search-inputs">
                        <div>
                            <label for="">{{ __('content.first_name') }}</label>
                            <input type="text" class="form-control man-search-input">
                        </div>
                        <div>
                            <label for="">{{ __('content.last_name') }}</label>
                            <input type="text" class="form-control man-search-input">
                        </div>
                        <div>
                            <label for="">{{ __('content.middle_name') }}</label>
                            <input type="text" class="form-control man-search-input">
                        </div>

                    </div>
                    <div class="full-name-block">
                        <label for="">{{ __('content.first_name') }} {{ __('content.middle_name') }} {{ __('content.last_name') }} </label>
                        <input type="text" class="full-name-input form-control">
                    </div>
                    <div class="button-block">
                        <button class="btn btn-primary search-input-btn">{{ __('button.search') }}</button>
                    </div>
                </div>
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
                        <table id="resizeMe" class="person_table table" data-table-name='{{ $page }}'
                            data-section-name="open" data-delete-url="/table-delete/{{ $page }}/">
                            <thead>

                                <tr>
                                    {{-- <th></th>
                                    <th></th>
                                    <th></th> --}}
                                    @can($page . '-edit')
                                        <th></th>
                                    @endcan
                                    <th></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id
                                        <i class="bi bi-funnel-fill" aria-hidden="true" data-field-name="id"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.last_name') }}
                                        <i class="bi bi-funnel-fill" aria-hidden="true" data-field-name="last_name"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.first_name') }}
                                        <i class="bi bi-funnel-fill" aria-hidden="true" data-field-name="first_name"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.middle_name') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="middle_name"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex">
                                        {{ __('content.date_of_birth_d') }}
                                        <i class="bi bi-funnel-fill" aria-hidden="true" data-field-name="birth_day"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex"
                                        title="Ծննդյան տարեթիվ(օր)">{{ __('content.date_of_birth_m') }}
                                        <i class="bi bi-funnel-fill" aria-hidden="true" data-field-name="birth_month"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex">
                                        {{ __('content.date_of_birth_y') }}
                                        <i class="bi bi-funnel-fill" aria-hidden="true" data-field-name="birth_year"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.first_name') }} {{ __('content.last_name') }}
                                        {{ __('content.middle_name') }}
                                        <i class="bi bi-funnel-fill" aria-hidden="true" data-field-name="full_name"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.place_of_birth') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="country_ate"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.place_of_birth_area') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="region"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.place_of_birth_settlement') }} <i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="locality"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.approximate_year') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="start_year"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.passport_number') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="passport"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.gender') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="gender"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.nationality') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="nation"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.citizenship') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="man_belongs_country"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.knowledge_of_languages') }} <i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="man_knows_language"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.attention') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="attention"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.additional_information_person') }} <i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="more_data"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worship') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="religion"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.occupation') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="occupation"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.country_carrying_out_search') }}<i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="country_search_man"
                                            data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.operational_category_person') }}<i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="operation_category"
                                            data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.declared_wanted_list_with') }}<i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="start_wanted"
                                            data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.home_monitoring_start') }}<i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="entry_date" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.end_monitoring_start') }}<i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="exit_date" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.education') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="education" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.party') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="party" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.alias') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="nickname" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.face_opened') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="opened_dou" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_inf') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="resource" data-section-name="open"></i>
                                    </th>

                                    {{-- <th class="filter-th" data-sort="null" data-type="filter-complex">
                                        {{ __('content.short_photo') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="photo_count" data-section-name="open"></i>
                                    </th> --}}
                                    {{-- <th></th>
                                    <th></th> --}}
                                    @if (isset(request()->main_route) || !empty($add))
                                        <th></th>
                                    @endif
                                    @can($page . '-delete')
                                        <th></th>
                                    @endcan
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($data as $man)
                                    <tr style="background-color: {{ $man->signalCount() > 0 ? '#f44336d1' : 'none'  }}">
                                        {{-- <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                                data-bs-target="#announcement_modal" data-type="tocsin">Ահազանգ</span>
                                        </td> --}}
                                        {{-- <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                                data-bs-target="#announcement_modal" data-type="not_providing">Տվյալների
                                                չտրամադրում</span></td>
                                        <td style="text-align: center"><span class="announcement_modal_span"
                                                data-bs-toggle="modal" data-bs-target="#announcement_modal"
                                                data-type="not_providing"><i
                                                    class="bi bi-exclamation-circle open-exclamation"
                                                    title="Տվյալների չտրամադրում"></i></span></td> --}}
                                        @can($page . '-edit')
                                            <td style=" text-align:center; align-items: center;">
                                                <a href="{{ route('man.edit', $man->id) }}">
                                                    <i class="bi bi-pencil-square open-edit" title="խմբագրել"></i>
                                                </a>
                                            </td>
                                        @endcan
                                        <td style="text-align: center"><i class="bi bi-eye open-eye" title="Դիտել"
                                                data-id="{{ $man->id }}"> </i>
                                        </td>
                                        <td>{{ $man->id }}</td>
                                        <td>
                                            @foreach ($man->lastName1 as $l_name)
                                                {{ $l_name->last_name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($man->firstName1 as $f_name)
                                                {{ $f_name->first_name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($man->middleName1 as $m_name)
                                                {{ $m_name->middle_name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $man->birth_day ?? '' }}</td>
                                        <td>{{ $man->birth_month ?? '' }}</td>
                                        <td>{{ $man->birth_year ?? '' }}</td>
                                        <td>
                                            {{ $man->full_name }}
                                        </td>
                                        <td>{{ $man->bornAddress->countryAte->name ?? '' }}</td>
                                        <td>{{ $man->bornAddress->region->name ?? '' }}</td>
                                        <td>{{ $man->bornAddress->locality->name ?? '' }}</td>
                                        <td>{{ $man->start_year ?? '' }} {{ $man->end_year ?? '' }}</td>
                                        <td>
                                            @foreach ($man->passport as $passport)
                                                {{ $passport->number }}
                                            @endforeach
                                        </td>
                                        <td>{{ $man->gender->name ?? '' }}</td>
                                        <td>{{ $man->nation->name ?? '' }}</td>
                                        <td>
                                            @foreach ($man->country as $country)
                                                {{ $country->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($man->knows_languages as $lang)
                                                {{ $lang->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $man->attention ?? '' }}</td>
                                        <td>
                                            @foreach ($man->more_data as $more_data)
                                                {{ $more_data->text }}
                                            @endforeach
                                        </td>
                                        <td>{{ $man->religion->name ?? '' }}</td>
                                        <td>{{ $man->occupation }}</td>
                                        <td>
                                            @foreach ($man->search_country as $country)
                                                {{ $country->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($man->operationCategory as $cat)
                                                {{ $cat->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $man->start_wanted ?? '' }}</td>
                                        <td>{{ $man->entry_date ?? '' }}</td>
                                        <td>{{ $man->exit_date ?? '' }}</td>
                                        <td>
                                            @foreach ($man->education as $edu)
                                                {{ $edu->name }}
                                            @endforeach
                                        </td>


                                        <td>
                                            @foreach ($man->party as $party)
                                                {{ $party->name }}
                                            @endforeach

                                        </td>
                                        <td>
                                            @foreach ($man->nickname as $nickname)
                                                {{ $nickname->name }}
                                            @endforeach
                                        </td>

                                        <td>{{ $man->opened_dou ?? '' }}</td>
                                        <td>{{ $man->resource->name ?? '' }}</td>

                                        @if (request()->model === 'bibliography')0
                                            <td style="text-align: center">
                                                <a href="{{ route('add_objects_relation', ['main_route' => request()->main_route, 'relation' => request()->relation, 'relation_id' => request()->id, 'model' => 'man', 'id' => $man->id]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @elseif ((isset(request()->main_route) && isset(request()->relation)) || $add)1
                                            <td style="text-align: center">
                                                {{-- <a href="{{route('open.redirect', $address->id )}}"> --}}
                                                <a href="{{ route('add_relation', ['main_route' => request()->main_route, 'model_id' => request()->model_id, 'relation' => request()->relation, 'fieldName' => 'man_id', 'id' => $man->id]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @elseif(isset(request()->main_route) && !isset(request()->relation))2
                                            <td style="text-align: center">
                                                <a href="{{ route('open.redirect', ['main_route' => request()->main_route, 'model' => 'man', 'route_name' => request()->route_name, 'model_id' => $man->id, 'route_id' => request()->route_id ?? request()->model_id, 'redirect' => request()->redirect]) }}">
                                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i>
                                                </a>
                                            </td>
                                        @endif
                                        @can($page . '-delete')
                                            <td style="text-align: center">
                                                <button class="btn_close_modal my-delete-item" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal" data-id="{{ $man->id }}"><i
                                                        class="bi bi-trash3"></i>
                                                </button>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="countries-list"></div>

                </div>
            </div>
        </div>
    </section>
    <div>
        <!-- add Person table end -->

        <!-- large modal blog -->
        {{-- <div class="modal fade" id="announcement_modal" tabindex="-1" aria-labelledby="exampleModalLgLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="exampleModalLgLabel">Ավելացնել նոր գրառում</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="large-modalBlock">
                            <div class="mb-3 announcement-input-block">
                                <label for="start_of_announcement" class="form-label">Հայտարարման սկիզբ</label>
                                <input style="position: relative;" type="date" class="form-control"
                                    id="start_of_announcement">
                            </div>
                            <div class="mb-3 announcement-input-block">
                                <label for="end_of_announcement" class="form-label">Հայտարարման ավարտ</label>
                                <input style="position: relative;" type="date" class="form-control"
                                    id="end_of_announcement">
                            </div>
                            <div class="mb-3 announcement-input-block">
                                <label for="exampleFormControlTextarea1" class="form-label">Նկարագրություն</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                        </div>
                        <div class="modal-button">
                            <button class='btn
                            btn-primary my-class-sub'
                                data-bs-dismiss="modal">Ավելացնել</button>
                        </div>

                    </div>
                </div>
            </div> --}}

        <!-- modal block -->
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


            let dinamic_field_name = "{{ __('content.field_name') }}"
            let dinamic_content = "{{ __('content.content') }}"
            let ties = "{{ __('content.ties') }}"
            let parent_table_name = "{{ __('content.man') }}"
            let fieldName = 'man_id'
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
        </script>
        <script src='{{ asset('assets/js/main/table.js') }}'></script>
        <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
        <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
    @endsection

@endsection
