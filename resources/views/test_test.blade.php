@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/dictionary/dictionary.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection


@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Գործածողների ցուցակ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">
                        Տվյալների մուտքագրում ֆայլերի միջոցով
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- List of users -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary my-opModal" data-bs-toggle="modal"
                        data-bs-target="#exampleModalLg">Ավելացնել նոր գրառում</button>


                    <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/" data-edit-url="cc/edit"
                        data-create-url="cc/create">
                        <thead>
                            <tr>
                                <th>Id</th>

                                <th class="filter-th" data-sort="null" data-type="standart">
                                    Անվանում <i class="fa fa-filter" data-field-name="name" aria-hidden="true"></i>
                                </th>
                                <th></th>

                            </tr>

                        </thead>
                        <tbody>

                            <tr>

                                <td class="trId">1</td>
                                <td class="tdTxt">
                                    {{-- pahel --}}
                                    <span>ffff</span>
                                    <input type="text" class="form-control" required placeholder="" />
                                    {{-- esqan@ --}}
                                </td>
                                <td>
                                    {{-- pahel --}}
                                    <a class="my-edit" href="#"><i class="bi bi-pencil-square"></i></a>
                                    {{-- esqan@ --}}
                                    <button class="btn_close_modal my-delete-item" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-id="1"><i class="bi bi-trash3"></i>
                                    </button>
                                    {{-- pahel --}}
                                    <button class="btn btn-primary my-btn-class my-sub">Թարմացնել</button>
                                    <button class="btn btn-secondary my-btn-class my-close">Չեղարկել</button>
                                    {{-- esqan@ --}}

                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- new table --}}

                    {{-- <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/"
                        data-status-url="bbb/status/">
                        <thead>
                            <tr>
                                <th class="filter-th" data-sort="null" data-type="filter-id">
                                    Id
                                    <i class="fa fa-filter" data-field-name="id" aria-hidden="true"></i>
                                </th>
                                <th class="filter-th" data-sort="null" data-type="standart">
                                    Գործածողների անուն
                                    <i class="fa fa-filter" data-field-name="username" aria-hidden="true"></i>
                                </th>
                                <th class="filter-th" data-sort="null" data-type="standart">
                                    Անուն <i class="fa fa-filter" data-field-name="first_name" aria-hidden="true"></i>
                                </th>
                                <th class="filter-th" data-sort="null" data-type="standart">
                                    Ազգանուն<i class="fa fa-filter" data-field-name="last_name" aria-hidden="true"></i>
                                </th>
                                <th class="filter-th" data-sort="null" data-type="standart">
                                    Տարատեսակ<i class="fa fa-filter" data-field-name="roles" aria-hidden="true"></i>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="current-id" data-id="1">
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="#"><i class="bi bi-pencil-square"></i></a>
                                </td>
                                <td>
                                    <button class="btn_close_modal" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="1">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </td>
                                <td>
                                    <input type="range" value="0" min="0" max="1" class="rangeInput"
                                        data-bs-toggle="modal" data-bs-target="#avtiveModal" />
                                </td>
                            </tr>
                            <tr class="current-id" data-id="2">
                                <td>2</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="#"><i class="bi bi-pencil-square"></i></a>
                                </td>
                                <td>
                                    <button class="btn_close_modal" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="2">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </td>
                                <td>
                                    <input type="range" value="0" min="0" max="1"
                                        class="rangeInput" data-bs-toggle="modal" data-bs-target="#avtiveModal" />
                                </td>
                            </tr>
                            <tr class="current-id" data-id="3">
                                <td>3</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="#"><i class="bi bi-pencil-square"></i></a>
                                </td>
                                <td>
                                    <button class="btn_close_modal" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="3">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </td>
                                <td>
                                    <input type="range" value="0" min="0" max="1"
                                        class="rangeInput" data-bs-toggle="modal" data-bs-target="#avtiveModal" />
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}



                </div>
            </div>
        </div>
    </section>

    <!-- modal block -->
    <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close close_modal" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_button"
                        data-bs-dismiss="modal">Չեղարկել</button>
                    <form action="" id="delete_form">
                        <button type="button" class="btn btn-primary" id="delete_button">Հաստատել</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal range -->

    <div class="modal" id="avtiveModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close close_modal" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancel_btn"
                        data-bs-dismiss="modal">Չեղարկել</button>
                    <form action="" id="status_form">
                        <button type="button" class="btn btn-primary" id="isActive_button"
                            data-bs-dismiss="modal">Հաստատել</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalLg" tabindex="-1" aria-labelledby="exampleModalLgLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalLgLabel">Ավելացնել նոր գրառում</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class='my-form-class' action="ghjk">
                        <div class="form-floating">
                            <input type="text" class="form-control" required placeholder="" />
                            <label class="form-label">Անվանում</label>
                        </div>

                        <button class='btn btn-primary my-class-sub'>Ավելացնել</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@section('js-scripts')
    <script src='{{ asset('assets/js/dictionary/dictionary.js') }}'></script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
@endsection

@endsection
