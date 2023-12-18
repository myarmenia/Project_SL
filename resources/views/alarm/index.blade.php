@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/alarm/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
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
                            <div class="form-floating">
                                <input
                                    style='outline: 3px solid red'
                                    type="text"
                                    class="form-control"
                                    id="item1"
                                    placeholder=""
                                    name="short_desc"
                                />
                                <label for="item1" class="form-label"
                                >1) Ահազանգի քարտի համար</label
                                >
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">2) Տեղեկատվության բովանդակաություն</label>
                            <a href="/btn1">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn1">
                            <div class="tegs-div-content"></div>
                        </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item2"
                                    placeholder=""
                                    name="short_desc"
                                />
                                <label for="item2" class="form-label"
                                >3) Հ/հ աշխատանքի ուղություն, որով ստուգվում է</label
                                >
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">4) Սահմանված ժամկետում ստացված արդյունքները</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn2"></div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    style='outline:3px solid red;'
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item3"
                                    placeholder=""
                                    data-id="3"
                                    name="access_level_id"
                                    list="brow1"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item3" class="form-label"
                                >5) Ահազանգի երանգավորում</label
                                >
                            </div>
                            <datalist id="brow1" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    style='outline:3px solid red;'
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item4"
                                    placeholder=""
                                    data-id="4"
                                    name="access_level_id"
                                    list="brow2"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item4" class="form-label"
                                >6) Տեղեկատվության աղբյուր</label
                                >
                            </div>
                            <datalist id="brow2" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    style='outline:3px solid red;'
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item5"
                                    placeholder=""
                                    data-id="5"
                                    name="access_level_id"
                                    list="brow3"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item5" class="form-label"
                                >7) Ահազանգ ստուգող վարչություն</label
                                >
                            </div>
                            <datalist id="brow3" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    style='outline:3px solid red;'
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item6"
                                    placeholder=""
                                    data-id="6"
                                    name="access_level_id"
                                    list="brow4"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item6" class="form-label"
                                >8) Ահազանգ ստուգող բաժին</label
                                >
                            </div>
                            <datalist id="brow4" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    style='outline:3px solid red;'
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item7"
                                    placeholder=""
                                    data-id="7"
                                    name="access_level_id"
                                    list="brow5"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item7" class="form-label"
                                >9) Ահազանգն ստուգող ստորաբաժանում</label
                                >
                            </div>
                            <datalist id="brow5" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item8"
                                    placeholder=""
                                    name="short_desc"
                                />
                                <label for="item8" class="form-label"
                                >10) Ահազանգն ստուգող օ/ա ԱՀԱ</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item9"
                                    placeholder=""
                                    data-id="9"
                                    name="access_level_id"
                                    list="brow6"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item9" class="form-label"
                                >11) Օ/ա պաշտոնը</label
                                >
                            </div>
                            <datalist id="brow6" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <!-- <div class="input-date-wrapper"> -->
                                <!-- <label for="inputDate1" role="value"></label>
                                <input type="text" hidden role="store" /> -->
                                <input
                                    style='outline:3px solid red;'
                                    type="date"
                                    placeholder=""
                                    id="item10"
                                    class="form-control"
                                    placaholder=""
                                    name="inp10"
                                    data-type="date"
                                />
                                <label for="item10" class="form-label"
                                >12) Ահազանգի բացման ամսաթիվ</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <!-- <div class="input-date-wrapper"> -->
                                <!-- <label for="inputDate1" role="value"></label>
                                <input type="text" hidden role="store" /> -->
                                <input
                                    style='outline:3px solid red;'
                                    type="date"
                                    placeholder=""
                                    id="item11"
                                    class="form-control"
                                    placaholder=""
                                    name="inp11"
                                    data-type="date"
                                />
                                <label for="item11" class="form-label"
                                >13) Ստուգման ժամկետի ամսաթիվ</label
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
                                    id="item12"
                                    class="form-control"
                                    placaholder=""
                                    name="inp12"
                                    data-type="date"
                                />
                                <label for="item12" class="form-label"
                                >14) Ստուգման ժամկետի երկարաձգման ամսաթիվ</label
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
                                    id="item13"
                                    class="form-control"
                                    placaholder=""
                                    name="inp13"
                                    data-type="date"
                                />
                                <label for="item13" class="form-label"
                                >15) Ահազանգի դադարեցման ամսաթիվ</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item14"
                                    placeholder=""
                                    name="short_desc"
                                />
                                <label for="item14" class="form-label"
                                >16) Ժամկետանց ահազանգերի օրերի քանակը</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item15"
                                    placeholder=""
                                    data-id="15"
                                    name="access_level_id"
                                    list="brow7"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item15" class="form-label"
                                >17) Ներգրավված ուժերը և միջոցները</label
                                >
                            </div>
                            <datalist id="brow7" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item16"
                                    placeholder=""
                                    data-id="16"
                                    name="access_level_id"
                                    list="brow8"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item16" class="form-label"
                                >18) Ստուգման արդյունքները</label
                                >
                            </div>
                            <datalist id="brow8" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item17"
                                    placeholder=""
                                    data-id="17"
                                    name="access_level_id"
                                    list="brow9"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item17" class="form-label"
                                >19) Ձեռնարկված միջոցները</label
                                >
                            </div>
                            <datalist id="brow9" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item18"
                                    placeholder=""
                                    name="short_desc"
                                />
                                <label for="item18" class="form-label"
                                >20) Ստուգման արդյունքներով բացվել է ՕՀԳ</label
                                >
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">21) Ստուգման արդյունքներով հարուցվել է քրեական գործ</label>
                            <a href="/btn3">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn3"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">22) Ահազանգի ստուգման օբյեկտները (անձ)</label>
                            <a href="/btn4">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn4"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">23) Ահազանգի ստուգման օբյեկտները (կազմակերպություն)</label>
                            <a href="/btn5">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn5"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">24) Ահազանգի ստուգման օբյեկտները (գործողություն)</label>
                            <a href="/btn6">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn6"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">25) Ահազանգի ստուգման օբյեկտները (իրադարձություն)</label>
                            <a href="/btn7">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn7"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">26) Անցնում է ահազանգով</label>
                            <a href="/btn8">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn8"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">27) Անցնում է ահազանգով (կազմակերպություն)</label>
                            <a href="/btn9">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn9"></div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    style='outline:3px solid red;'
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item19"
                                    placeholder=""
                                    data-id="19"
                                    name="access_level_id"
                                    list="brow10"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item19" class="form-label"
                                >28) Ահազանգը բացող վարչություն</label
                                >
                            </div>
                            <datalist id="brow10" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    style='outline:3px solid red;'
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item20"
                                    placeholder=""
                                    data-id="20"
                                    name="access_level_id"
                                    list="brow11"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item20" class="form-label"
                                >29) Ահազանգը բացող բաժին</label
                                >
                            </div>
                            <datalist id="brow11" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    style='outline:3px solid red;'
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item21"
                                    placeholder=""
                                    data-id="21"
                                    name="access_level_id"
                                    list="brow12"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item21" class="form-label"
                                >30) Ահազանգը բացող ստորաբաժանում</label
                                >
                            </div>
                            <datalist id="brow12" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item22"
                                    placeholder=""
                                    name="short_desc"
                                />
                                <label for="item22" class="form-label"
                                >31) Օ/ա Ա․Հ․Ազգանուն</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item23"
                                    placeholder=""
                                    data-id="23"
                                    name="access_level_id"
                                    list="brow13"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{route('get-model-filter',['path'=>'access_level'])}}'
                                    data-section='get-model-name-in-modal'
                                    data-id='access_level'
                                ></i>
                                <label for="item23" class="form-label"
                                >32) Օ/ա պաշտոնը</label
                                >
                            </div>
                            <datalist id="brow13" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">33) Ահազանգի վարումը</label>
                            <a href="/btn10">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn10"></div>
                        </div>


                        <div class="btn-div">
                            <label class="form-label">34) Փաստաթղթի բովանդակութըունը</label>
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
                            <label class="form-label">35) Կապեր</label>
                            <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police"></div>
                        </div>

                        <!-- Vertical Form -->

                </div>
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>

    @section('js-scripts')
        <script src='{{ asset('assets/js/alarm/script.js') }}'></script>
    @endsection
@endsection


