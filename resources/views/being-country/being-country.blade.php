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
                <x-form-error/>

                <!-- Vertical Form -->
                <form class="form" method="POST" action="{{route('bean-country.store', $man->id)}}">
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="goal_id"
                                    value="">
                                <input
                                    type="text"
                                    class="form-control get_datalist set_value"
                                    id="goal"
                                    placeholder=""
                                    data-id=""
                                    tabindex="1"
                                    data-model="goal"
                                    data-fieldname="name"
                                    list="goal-list"/>
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='goal'
                                    data-fieldname='name'
                                ></i>
                                <label for="character" class="form-label"
                                >1) Մուտքի նպատակ</label
                                >
                            </div>
                            <datalist id="goal-list" class="input_datalists" style="width: 500px;">
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="country_ate_id"
                                    value="">
                                <input
                                    type="text"
                                    class="form-control save_input_data set_value"
                                    id="country_ate"
                                    placeholder=""
                                    data-id=""
                                    tabindex="2"
                                    data-type="location"
                                    data-table="country_ate_id"
                                    data-model="countryAte"
                                    list="country_ate-list"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='country_ate'
                                    data-fieldname='name'
                                ></i>
                                <label for="country_ate" class="form-label"
                                >2) Երկիր, ՎՏՄ</label
                                >
                            </div>
                            <datalist id="country_ate-list" class="input_datalists" style="width: 500px;">
                                <option></option>
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
                                    id="entry_date"
                                    class="form-control"
                                    name="entry_date"
                                    tabindex="3"
                                />
                                <label for="entry_date" class="form-label">
                                    3) Մուտքի ամսաթիվ
                                </label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input
                                    type="date"
                                    placeholder=""
                                    id="exit_date"
                                    class="form-control"
                                    name="exit_date"
                                    tabindex="4"
                                />
                                <label for="exit_date" class="form-label">
                                    4) Ելքի ամսաթիվ
                                </label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="region_id"
                                    value="">
                                <input
                                    type="text"
                                    class="form-control save_input_data set_value"
                                    id="region"
                                    placeholder=""
                                    data-id=""
                                    tabindex="5"
                                    data-type="region"
                                    data-table="region_id"
                                    list="region-list"
                                    data-disabled="region2"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='region'
                                    data-fieldname='name'
                                ></i>
                                <label for="region" class="form-label"
                                >5) Մարզ (տեղական)</label
                                >
                            </div>
                            <datalist id="region-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="locality_id"
                                    value="">
                                <input
                                    type="text"
                                    class="form-control save_input_data set_value"
                                    id="locality"
                                    placeholder=""
                                    data-id=""
                                    tabindex="2"
                                    data-type="locality"
                                    data-table="locality_id"
                                    list="locality-list"
                                    data-disabled="locality2"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='locality'
                                    data-fieldname='name'
                                ></i>
                                <label for="locality" class="form-label">
                                    6) Բնակավայր (տեղական)
                                </label
                                >
                            </div>
                            <datalist id="locality-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control  save_input_data"
                                    id="region2"
                                    placeholder=""
                                    name="region_id"
                                    data-disabled="region"
                                />
                                <label for="region2" class="form-label"
                                >7) Շրջան</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control  save_input_data"
                                    id="locality2"
                                    placeholder=""
                                    name="locality_id"
                                    data-disabled="locality"
                                />
                                <label for="locality2" class="form-label"
                                >8) Բնակավայր</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <label for="inputDate2" class="form-label">9) Կապեր</label>
                            <div class="tegs-div"></div>
                            <button type="submit" class="submit-btn">submit</button>
                        </div>

                        <!-- ######################################################## -->
                        <!-- Submit button -->
                        <!-- ######################################################## -->
                </form>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>


    @section('js-scripts')
        <script>
            let parent_id = "{{$man->id}}"
            let open_modal_url = "{{route('open.modal')}}"
            let lang = "{{app()->getLocale()}}"
        </script>

        <script src="{{ asset('assets/js/script.js') }}"></script>
        {{--        <script src="{{ asset('assets/js/being-country/script.js') }}"></script>--}}
    @endsection
@endsection

