@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/organization/organization.css') }}">
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Անձի աշխատանքային գործունեություն</h1>
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
                <form class="form" method="POST"
                      action="{{route('organization.store', $manId)}}">
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control"
                                        id="inputDate2"
                                        placeholder=""
                                        name="title"
                                />
                                <label for="inputDate2" class="form-label"
                                >1) Պաշտոն</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control"
                                        id="inputDate2"
                                        placeholder=""
                                        name="period"
                                />
                                <label for="inputDate2" class="form-label"
                                >2) Տեղեկությունները վերաբերվում են ժամանակաշրջանին</label
                                >
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
                                        id="inputDate1"
                                        class="form-control"
                                        name="start_date"
                                />
                                <label for="inputDate1" class="form-label"
                                >3) Աշխատանքային գործունեության սկիզբ</label
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
                                        id="inputDate1"
                                        class="form-control"
                                        name="end_date"
                                />
                                <label for="inputDate1" class="form-label"
                                >4) Աշխատանքային գործունեության ավարտ</label
                                >
                                <!-- </div> -->
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">5) Աշխատանքը կազմակերպությունում</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv15"></div>
                        </div>


                    </div>


                    <!-- ######################################################## -->
                    <input value="1" name="organization_id" hidden>
                    <button type="submit"> submit</button>
                    <!-- Submit button -->
                    <!-- ######################################################## -->
                </form>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>



    @section('js-scripts')
        <script src="{{ asset('assets/js/organization/script.js') }}"></script>
    @endsection
@endsection

