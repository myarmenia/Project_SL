@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/police/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Անցնում է ոստիկանության ամփոփագրով</h1>
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
                            <div class="form-floating input-date-wrapper">
                                <!-- <div class="input-date-wrapper"> -->
                                <!-- <label for="inputDate1" role="value"></label>
                                <input type="text" hidden role="store" /> -->
                                <input
                                        type="date"
                                        placeholder=""
                                        id="inputDate1"
                                        class="form-control"
                                        name="inp1"
                                />
                                <label for="inputDate1" class="form-label"
                                >1)  ամԱմփոփագրի գրանցման ասաթիվ</label
                                >
                                <!-- </div> -->
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">2) Տեղեկության բովանդակություն</label>
                            <a href="/btn1">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv1" id="btn1"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">3) Ամփոփագրով անցնող անձինք</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv1" id="btn2"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">4) Ամփոփագրով անցնող կազմակերպություններ</label>
                            <a href="/btn3">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv1" id="btn3"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">5) Փաստաթղթի բովանդակութըունը</label>
                            <div class="file-upload-content tegs-div">
                            <div class="Myteg">
                                <span><a href="">dddd</a></span>
                            </div>
                            <div class="Myteg">
                                <span><a href="">ffff</a></span>
                            </div>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">6) Կապեր</label>
                            <div class="tegs-div" name="tegsDiv1" id="company-police"><div class="tegs-div-content"></div></div>
                        </div>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>

    @section('js-scripts')
        <script src='{{ asset('assets/js/police/script.js') }}'></script>
    @endsection
@endsection

