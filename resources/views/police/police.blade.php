@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/police/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/calendar.css') }}">

@endsection

@section('content')

    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <p> id: 555</p>

                <!-- Vertical Form -->
                <div class="form">
                    <div class="inputs row g-3">

                    <div class="col">
                            <div class="form-floating input-date-wrapper calendar-container">
                                <!-- <div class="input-date-wrapper"> -->
                                <!-- <label for="inputDate1" role="value"></label>
                                <input type="text" hidden role="store" /> -->
                                <input
                                        type="text"
                                        placeholder=""
                                        id="inputDate1"
                                        class="form-control calendarInput"
                                        name="inp1"
                                        data-check="date"
                                        autocomplete="off" onblur="handleBlur(this)"
                                />
                                <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>

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
        <script src='{{ asset('assets/js/main/date.js') }}'></script>

    @endsection
@endsection

