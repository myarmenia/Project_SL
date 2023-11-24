@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/availability-gun/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Զենքի առկայություն</h1>
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
                                class="form-control"
                                id="item1"
                                placeholder=""
                                name="inp1"
                            />
                            <label for="item1" class="form-label"
                                >1) Զենքի հանձման տեսակ</label
                            >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                            <input
                                type="text"
                                class="form-control"
                                id="item2"
                                placeholder=""
                                name="inp2"
                            />
                            <label for="item3" class="form-label"
                                >2) Տեսակ</label
                            >
                            </div>
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
                                >3) Տարատեսակ</label
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
                                >4) Մակնիշ</label
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
                            <label for="item5" class="form-label">5) Հաշվառման համարը</label>
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
                            <label for="item6" class="form-label">6) Քանակը</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">7) Կապեր</label>
                            <div class="tegs-div" id="company-police"></div>
                        </div>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>

    @section('js-scripts')
        <script src='{{ asset('assets/js/availability-gun/script.js') }}'></script>
    @endsection
@endsection
