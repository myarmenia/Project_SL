@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.man') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.man') }}
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
                        <table id="resizeMe" class="person_table table" data-table-name='man' data-section-name="open">
                            <thead>
                                <tr>
                                    {{-- <th></th>
                                    <th></th>
                                    <th></th> --}}
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="id"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.last_name') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="last_name"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.first_name') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="first_name"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.middle_name') }} <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex">
                                        {{ __('content.date_of_birth_d') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="birth_day"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex"
                                        title="Ծննդյան տարեթիվ(օր)">{{ __('content.date_of_birth_m') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="birth_month"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex">
                                        {{ __('content.date_of_birth_y') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="birth_year"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.first_name') }} {{ __('content.last_name') }}
                                        {{ __('content.middle_name') }}
                                        <i class="fa fa-filter" aria-hidden="true" data-field-name="man_auto"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.place_of_birth') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="country_ate"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.place_of_birth_area') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="region"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.place_of_birth_settlement') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name="locality"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.approximate_year') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="approximate_year"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.passport_number') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="passport"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.gender') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="gender"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.nationality') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="nation"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.citizenship') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="man_belongs_country"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.knowledge_of_languages') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name="man_knows_language"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.attention') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="attention"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.additional_information_person') }} <i class="fa fa-filter"
                                            aria-hidden="true" data-field-name="more_data"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.worship') }} <i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="relegion"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.occupation') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="occupation"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.country_carrying_out_search') }}<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name="country_search_man"
                                            data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.operational_category_person') }}<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name="operation_category"
                                            data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.declared_wanted_list_with') }}<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name="start_wanted"
                                            data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th"
                                            data-sort="null" data-type="filter-complex-date">
                                            {{ __('content.home_monitoring_start') }}<i class="fa fa-filter"
                                                aria-hidden="true" data-field-name="entry_date" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date">
                                        {{ __('content.end_monitoring_start') }}<i class="fa fa-filter"
                                            aria-hidden="true" data-field-name="exit_date" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.education') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="education" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.party') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="party" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.alias') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="nickname" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.face_opened') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="opened_dou" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.source_inf') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="resource" data-section-name="open"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="filter-complex">
                                        {{ __('content.short_photo') }}<i class="fa fa-filter" aria-hidden="true"
                                            data-field-name="photo_count" data-section-name="open"></i>
                                    </th>

                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($data as $man)
                                    <tr>
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
                                        <td style=" text-align:center; align-items: center;"><a
                                                href="{{ route('man.edit', $man->id) }}"><i
                                                    class="bi bi-pencil-square open-edit" title="խմբագրել"></i></a></td>
                                        <td style="text-align: center"><a
                                                href="{{ route('open.page.restore', [$page, $man->id]) }}"
                                                title="վերականգնել"><i
                                                    class="bi bi-arrow-down-up open-regenerate"></i></a></td>
                                        <td style="text-align: center"><i class="bi bi-eye open-eye" title="Դիտել"> </i>
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
                                            @foreach ($man->lastName1 as $l_name)
                                                {{ $l_name->last_name }}
                                            @endforeach
                                            @foreach ($man->firstName1 as $f_name)
                                                {{ $f_name->first_name }}
                                            @endforeach
                                            @foreach ($man->middleName1 as $m_name)
                                                {{ $m_name->middle_name }}
                                            @endforeach
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
                                        <td>{{ $man->photo_count() }}</td>
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
        <!-- add Person table end -->

        <!-- large modal blog -->
        <div class="modal fade" id="announcement_modal" tabindex="-1" aria-labelledby="exampleModalLgLabel"
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
            </div>

            <!-- modal block -->
            @include('components.delete-modal')



        @section('js-scripts')
            <script src='{{ asset('assets/js/main/table.js') }}'></script>
            <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
        @endsection

    @endsection
