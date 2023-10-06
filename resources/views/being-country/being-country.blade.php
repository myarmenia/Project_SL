@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/being-country/style.css') }}">
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Արտասահմանում Գտնվելը</h1>
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
                <form class="form" method="POST" action="{{route('organization.store', $manId)}}">
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->

                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control fetch_input_title"
                                        id="item1"
                                        placeholder=""
                                        data-id="1"
                                        value=""
                                        name="inp1"
                                        list="brow1"
                                />
                                <i
                                        class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fullscreenModal"
                                        data-url="url/1"
                                ></i>
                                <label for="item1" class="form-label"
                                >1) Մուտքի նպատակ</label
                                >
                            </div>

                            <datalist id="brow1" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control fetch_input_title"
                                        id="item2"
                                        placeholder=""
                                        data-id="2"
                                        value=""
                                        name="inp2"
                                        list="brow2"
                                />
                                <i
                                        class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fullscreenModal"
                                        data-url="url/2"
                                ></i>
                                <label for="item2" class="form-label"
                                >2) Երկիր, ՎՏՄ</label
                                >
                            </div>

                            <datalist id="brow2" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <!-- <div class="input-date-wrapper"> -->
                                <!-- <label for="inputDate1" role="value"></label>
                                <input type="text" hidden role="store" /> -->
                                <input
                                        type="date"
                                        placeholder=""
                                        id="inputDate1"
                                        class="form-control"
                                        placaholder=""
                                        name="inp5"
                                />
                                <label for="inputDate1" class="form-label"
                                >3) Մուտքի ամսաթիվ</label
                                >
                                <!-- </div> -->
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <!-- <div class="input-date-wrapper"> -->
                                <!-- <label for="inputDate1" role="value"></label>
                                <input type="text" hidden role="store" /> -->
                                <input
                                        type="date"
                                        placeholder=""
                                        id="inputDate2"
                                        class="form-control"
                                        placaholder=""
                                        name="inp6"
                                />
                                <label for="inputDate2" class="form-label"
                                >4) Ելքի ամսաթիվ</label
                                >
                                <!-- </div> -->
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control fetch_input_title"
                                        id="item3"
                                        placeholder=""
                                        data-id="3"
                                        value=""
                                        name="inp3"
                                        list="brow3"
                                />
                                <i
                                        class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fullscreenModal"
                                        data-url="url/3"
                                ></i>
                                <label for="item3" class="form-label"
                                >5) Մարզ (տեղական)</label
                                >
                            </div>

                            <datalist id="brow3" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control fetch_input_title"
                                        id="item4"
                                        placeholder=""
                                        data-id="4"
                                        value=""
                                        name="inp4"
                                        list="brow4"
                                />
                                <i
                                        class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fullscreenModal"
                                        data-url="url/4"
                                ></i>
                                <label for="item4" class="form-label"
                                >6) Բնակավայր (տեղական)</label
                                >
                            </div>

                            <datalist id="brow4" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control"
                                        id="inputDate2"
                                        placeholder=""
                                        name="inp8"
                                />
                                <label for="inputDate2" class="form-label"
                                >7) Շրջան</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control"
                                        id="inputDate3"
                                        placeholder=""
                                        name="inp9"
                                />
                                <label for="inputDate3" class="form-label"
                                >8) Բնակավայր</label
                                >
                            </div>
                        </div>

                        <div class="col">

                            <label for="inputDate2" class="form-label">9) Կապեր</label>
                            <div class="tegs-div"></div>
                        </div>
                        <!-- ######################################################## -->
                        <!-- Submit button -->
                        <!-- ######################################################## -->
                </form>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>


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
        <script src="{{ asset('assets/js/being-country/script.js') }}"></script>
    @endsection
@endsection

