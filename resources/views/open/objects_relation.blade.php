@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.objects_relation') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.objects_relation') }}
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
                                            aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.character_link') }} <i class="fa fa-filter" aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id"> {{ __('content.first') }}<i class="fa fa-filter"
                                            aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="filter-id">{{ __('content.second') }}<i class="fa fa-filter"
                                            aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.first_object_type') }} <i class="fa fa-filter" aria-hidden="true"></i></th>

                                    <th class="filter-th" data-sort="null" data-type="standart-complex">
                                        {{ __('content.second_object_type') }} <i class="fa fa-filter" aria-hidden="true"></i></th>


                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: center"><span class="announcement_modal_span" data-bs-toggle="modal"
                                        data-bs-target="#announcement_modal" data-type="not_providing"><i class="bi bi-exclamation-circle open-exclamation" title="Տվյալների չտրամադրում"></i></span></td>
                                    <td style=" text-align:center; align-items: center;"><i class="bi bi-pencil-square open-edit" title="խմբագրել"></i></td>
                                    <td style="text-align: center"><a href="{{ route('open.page.restore', [$page, 1]) }}" title="վերականգնել"><i class="bi bi-arrow-down-up open-regenerate"></i></a></td>
                                    <td style="text-align: center"><i class="bi bi-eye open-eye" title="Դիտել"> </i></td>
                                    <td>26409</td>
                                    <td>knjnjnjnjnjn</td>
                                    <td>269</td>
                                    <td>2649</td>
                                    <td>Garik</td>
                                    <td>flkjgnbh</td>
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
