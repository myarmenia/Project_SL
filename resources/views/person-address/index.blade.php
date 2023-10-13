@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/man/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/person-address/index.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Անձի բնակության վայրը</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">

                <!-- Vertical Form -->
                <form class="form">
                    <div class="inputs row g-3">
                        <!-- Selects -->

                        <div class="col">
                <span class="radio_span">
                    <input type="radio" name="isActive" checked class="district_isActive_notActive">
                </span>
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item1"
                                    placeholder=""
                                    data-id="1"
                                    name="inp1"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/1"
                                ></i>
                                <label for="item1" class="form-label"
                                >1) Երկիր, ՎՏՄ, տարածաշրջան</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActive_address"
                                    id="item2"
                                    placeholder=""
                                    data-id="2"
                                    name="inp2"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class  not_active"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/2"
                                ></i>
                                <label for="item2" class="form-label"
                                >2) Մարզ (տեղական)</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActive_address"
                                    id="item3"
                                    placeholder=""
                                    data-id="3"
                                    name="inp3"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class not_active "
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/3"
                                ></i>
                                <label for="item3" class="form-label"
                                >3) Բնակավայր (տեղական)</label
                                >
                            </div>
                        </div>

                        <div class="col">

                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActive_address"
                                    id="item4"
                                    placeholder=""
                                    data-id="4"
                                    name="inp4"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class  not_active"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                ></i>
                                <label for="item4" class="form-label"
                                >4) Փողոց (տեղական)</label
                                >
                            </div>
                        </div>

                        <div class="col">
                <span class="radio_span">
                    <input type="radio" name="isActive" class="address_isActive_notActive">
                </span>
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActiv_district"
                                    id="inputPassportNumber1"
                                    placeholder=""
                                    name="inp5"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >5) Շրջան</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActiv_district"
                                    id="inputPassportNumber1"
                                    placeholder=""
                                    name="inp6"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >6) Բնակավայր</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActiv_district"
                                    id="inputPassportNumber1"
                                    placeholder=""
                                    name="inp7"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >7) Փողոց</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputPassportNumber1"
                                    placeholder=""
                                    name="inp8"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >8) Աշխարհագրական տեղանք</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputPassportNumber1"
                                    placeholder=""
                                    name="inp9"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >9) Տան համարը</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputPassportNumber1"
                                    placeholder=""
                                    name="inp10"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >10) Շենքի համարը</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputPassportNumber1"
                                    placeholder=""
                                    name="inp11"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >11) Բնակարանի համարը</label
                                >
                            </div>
                        </div>
                        <!-- Date Inputs -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" placeholder="" class="form-control" name="inp12"/>
                                <label class="form-label"
                                >12) Բնակվելու սկիզբ (օր, ամիս, տարի)</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" placeholder="" class="form-control" name="inp13"/>
                                <label class="form-label">13) Բնակվելու ավարտ (օր, ամիս, տարի)</label>
                            </div>
                        </div>
                        <!-- Selects -->

                        <div class="btn-div">
                            <label class="form-label">14) Կապեր</label>
                            <div class="tegs-div" name="tegsDiv14 ">
                                <div class="Myteg">
                                    <span>kkkk</span>
                                    <span>X</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- ######################################################## -->
                    <!-- Submit button -->
                    <!-- ######################################################## -->
                </form>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>
    <a
        href="#"
        class="back-to-top d-flex align-items-center justify-content-center"
    ><i class="bi bi-arrow-up-short"></i
        ></a>

    <!-- ########################################################################### -->
    <!-- ############################## Modals #################################### -->
    <!-- ########################################################################### -->

    <!-- fullscreenModal -->
    <div
        class="modal fade my-modal"
        id="fullscreenModal"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <form id="addNewInfoBtn">
                        <div class="form-floating">
                            <input
                                type="text"
                                class="form-control"
                                id="addNewInfoInp"
                                placeholder=""
                            />
                            <label for="item21" class="form-label"
                            >Ֆիլտրացիա</label
                            >
                        </div>

                        <button type="submit" class="btn btn-primary">Ավելացնել նոր գրանցում</button>


                    </form>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="numbering" scope="col">#</th>
                            <th scope="col">Անվանում</th>
                            <th scope="col" class="td-xs"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td class="inputName">ggg</td>
                            <td>
                                <button type="button" class="addInputTxt btn btn-primary" data-bs-dismiss="modal"
                                        aria-label="Close">Ավելացնել
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="inputName">fff</td>
                            <td>
                                <button type="button" class="addInputTxt btn btn-primary" data-bs-dismiss="modal"
                                        aria-label="Close">Ավելացնել
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @section('js-scripts')
        <script src='{{ asset('assets/js/person-address/index.js') }}'></script>
    @endsection
@endsection
