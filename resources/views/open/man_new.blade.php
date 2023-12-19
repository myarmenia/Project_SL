@extends('layouts.auth-app')

@section('content')

    <section class="section">
        <div class="col">
            <div class="card">
                @if (request()->routeIs('optimization.*'))
                    @include('layouts.table_buttons')
                @endif
                <x-btn-create-clear-component route="man.create" />
                <div class="man-search-inputs-block">
                    <div class="man-search-inputs">
                        <div class="id-block">
                            <label for="">Id</label>
                            <input type="number" min="1" class="id-filter-input form-control">
                        </div>
                        <div>
                            <label for="">{{ __('content.last_name') }}</label>
                            <input type="text" class="form-control man-search-input">
                        </div>
                        <div>
                            <label for="">{{ __('content.first_name') }}</label>
                            <input type="text" class="form-control man-search-input">
                        </div>
                        
                        <div>
                            <label for="">{{ __('content.middle_name') }}</label>
                            <input type="text" class="form-control man-search-input">
                        </div>

                    </div>
                    <div class="full-name-block">
                        <label for="">{{ __('content.first_name') }} {{ __('content.middle_name') }}
                            {{ __('content.last_name') }} </label>
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
                        <b>0</b>
                        {{ __('content.table_data') }}
                    </div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" data-table-name='man'
                            data-section-name="open" data-delete-url="/table-delete/man/">
                            <thead>

                                <tr>
                                    {{-- <th></th>
                                    <th></th>
                                    <th></th> --}}
                                    @can('man-edit')
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
                                        {{ __('content.place_of_birth_area') }}<i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="region"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.place_of_birth_settlement') }} <i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="locality"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.approximate_year') }}<i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="start_year"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.passport_number') }}<i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="passport"></i>
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

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.date_and_time_date') }}<i class="bi bi-funnel-fill"
                                            aria-hidden="true" data-field-name="created_at" data-section-name="open"></i>
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
                                    @can('man-delete')
                                        <th></th>
                                    @endcan
                                </tr>

                            </thead>
                            <tbody>
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

            @can('man-edit')
                allow_change = true
            @else
                allow_change = false
            @endcan

            @can('man-delete')
                allow_delete = true
            @else
                allow_delete = false
            @endcan

            let dinamic_field_name = "{{ __('content.field_name') }}"
            let dinamic_content = "{{ __('content.content') }}"

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
            let bibliography_id = null

            @if (isset($bibliography_id))
                bibliography_id = "{{ $bibliography_id }}"
            @endif
        </script>
        <script src='{{ asset('assets/js/main/table.js') }}'></script>
        <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
    @endsection

@endsection
