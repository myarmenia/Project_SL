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

                                <tr>

                                    <td style="text-align: center"><span class="announcement_modal_span" data-bs-toggle="modal"
                                        data-bs-target="#announcement_modal" data-type="not_providing"><i class="bi bi-exclamation-circle open-exclamation" title="Տվյալների չտրամադրում"></i></span></td>
                                        <td style="text-align: center"><a href="{{ route('open.page.restore', [$page, 1]) }}" title="վերականգնել"><i class="bi bi-arrow-down-up open-regenerate"></i></a></td>
                                    <td style=" text-align:center; align-items: center;"><i class="bi bi-pencil-square open-edit" title="խմբագրել"></i></td>
                                    <td style="text-align: center"><i class="bi bi-eye open-eye" title="Դիտել"> </i></td>

                                    <td>26409</td>
                                    <td>knjnjnjnjnjn</td>
                                    <td>dkdk</td>
                                    <td>dkfk</td>
                                    <td>dkkffk</td>
                                    <td>dkdk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>
                                    <td>dsdsk</td>

                                    <td style="text-align: center"><i class="bi bi-file-word open-word" title="Word ֆայլ"></i></td>
                                    <td style="text-align: center"><i class="bi bi-plus-square open-add" title="Ավելացնել"></i></td>
                                    <td style="text-align: center"><i class="bi bi-trash3 open-delete" title="Ջնջել"></i></td>
                                </tr> 


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
        <script src='{{ asset('assets/js/main/table.js') }}'></script>
        <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
    @endsection

@endsection

{{-- <thead>
    <tr>
        <th class="k-header"></th>
        <th class="k-header"></th>

        <th role="columnheader" data-field="id" data-title="Id" class="k-header k-filterable"
            data-role="sortable"><a class="k-grid-filter" href="#" tabindex="-1"><span
                    class="k-icon k-filter"></span></a><a class="k-link" href="#" tabindex="-1">Id</a>
        </th>

        <th role="columnheader" data-field="user_name" data-title="Փաստաթուղթը մուտքագրող օ/ա"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Փաստաթուղթը մուտքագրող օ/ա</a>
        </th>

        <th role="columnheader" data-field="created_at" data-title="Մուտքագրման ամսաթիվ"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Մուտքագրման ամսաթիվ</a>
        </th>

        <th role="columnheader" data-field="from_agency_name" data-title="Տեղեկատվությունը տրամադրող մարմին"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Տեղեկատվությունը տրամադրող մարմին</a>
        </th>

        <th role="columnheader" data-field="doc_category" data-title="Փաստաթղթի կատեգորիա"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Փաստաթղթի կատեգորիա</a>
        </th>

        <th role="columnheader" data-field="access_level" data-title="Մուտքի մակարդակը"
            class="k-header k-filterable" data-role="sortable" id="grid_bibliography_open728_active_cell"><a
                class="k-grid-filter" href="#" tabindex="-1"><span class="k-icon k-filter"></span></a><a
                class="k-link" href="#" tabindex="-1">Մուտքի մակարդակը</a>
        </th>

        <th role="columnheader" data-field="reg_number" data-title="Գրանցման համարը"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Գրանցման համարը</a>
        </th>

        <th role="columnheader" data-field="reg_date" data-title="Գրանցման ամսաթիվ"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Գրանցման ամսաթիվ</a>
        </th>

        <th role="columnheader" data-field="" data-title="Փաստաթուղթն ստացող օ/ա"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Փաստաթուղթն ստացող օ/ա</a>
        </th>

        <th role="columnheader" data-field="source_agency_name"
            data-title="Ստորաբաժանում, որտեղ պահվում են նախնական նյութերը" class="k-header k-filterable"
            data-role="sortable"><a class="k-grid-filter" href="#" tabindex="-1"><span
                    class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Ստորաբաժանում,

                >
                որտեղ պահվում են նախնական նյութերը</a>
        </th>

        <th role="columnheader" data-field="source_address" data-title="Նախնական նյութերի պահպանման տեղ"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Նախնական նյութերի պահպանման տեղ</a>
        </th>

        <th role="columnheader" data-field="short_desc" data-title="Փաստաթղթի համառոտ բովանդակությունը"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Փաստաթղթի համառոտ բովանդակությունը</a>
        </th>

        <th role="columnheader" data-field="related_year" data-title="Տեղեկությունը վերաբերում է … թ."
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Տեղեկությունը վերաբերում է … թ.</a>
            </th>

        <th role="columnheader" data-field="source" data-title="Տեղեկատվության աղբյուր"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Տեղեկատվության աղբյուր</a>
            </th>

        <th role="columnheader" data-field="country" data-title="Երկիր, որին վերաբերում է տեղեկությունը"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Երկիր, որին վերաբերում է տեղեկությունը</a>
            </th>

        <th role="columnheader" data-field="theme" data-title="Թեմատիկայի անվանումը"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Թեմատիկայի անվանումը</a>
            </th>

        <th role="columnheader" data-field="title" data-title="Փաստաթղթի վերնագիրը"
            class="k-header k-filterable" data-role="sortable"><a class="k-grid-filter" href="#"
                tabindex="-1"><span class="k-icon k-filter"></span></a><a class="k-link" href="#"
                tabindex="-1">Փաստաթղթի վերնագիրը</a>
            </th>

        <th role="columnheader" data-field="file_count" data-title="Ֆայլ" class="k-header k-filterable"
            data-role="sortable"><a class="k-grid-filter" href="#" tabindex="-1"><span
                    class="k-icon k-filter"></span></a><a class="k-link" href="#" tabindex="-1">Ֆայլ</a>
        </th>

        <th role="columnheader" data-field="video" data-title="Վիդեո" class="k-header k-filterable"
            data-role="sortable"><a class="k-grid-filter" href="#" tabindex="-1"><span
                    class="k-icon k-filter"></span></a><a class="k-link" href="#" tabindex="-1">Վիդեո</a>
        </th>

        <th class="k-header"></th>
        <th class="k-header"></th>
    </tr>
</thead> --}}
