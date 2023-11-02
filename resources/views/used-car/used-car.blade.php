@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/used-car/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Օգտագործվող ավտոմեքենա</h1>
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
                <p> id: 555</p>

                <!-- Vertical Form -->
                <div class="form">
                    <div class="inputs row g-3">

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
                                >1) Տրանսպորտային միջոցի տեսակ</label
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
                                <label for="item1" class="form-label"
                                >2) Մակնիշ</label
                                >
                            </div>

                            <datalist id="brow2" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                            <input
                                type="text"
                                class="form-control"
                                id="item3"
                                placeholder=""
                                name="inp3"
                            />
                            <label for="item3" class="form-label"
                                >3) Գույն կամ այլ տարբերող նշաններ</label
                            >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                            <input
                                type="text"
                                class="form-control"
                                id="item4"
                                placeholder=""
                                name="inp4"
                            />
                            <label for="item4" class="form-label"
                                >4) Պետհամարանիշ</label
                            >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                            <input
                                type="text"
                                class="form-control"
                                id="item5"
                                placeholder=""
                                name="inp5"
                            />
                            <label for="item5" class="form-label"
                                >5) Քանակ</label
                            >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                            <input
                                type="text"
                                class="form-control"
                                id="item6"
                                placeholder=""
                                name="inp6"
                            />
                            <label for="item6" class="form-label"
                                >6) Լրացուցիչ տվյալներ</label
                            >
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">7) Կապեր</label>
                            <div class="tegs-div" name="tegsDiv1" id="company-police">
                                <div class="tegs-div-content"></div>
                            </div>
                        </div>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>
   
    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>

    @section('js-scripts')
        <script src='{{ asset('assets/js/used-car/script.js') }}'></script>
    @endsection
@endsection
