@extends('layouts.auth-app')

@section('style')

    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/action/style.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Գործողություն</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active model-id" data-model-id='{{$action->id}}'><b>
                            ID: {{$action->id}}</b>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">

                <!-- Vertical Form -->
                <div class="form">
                    <div class="inputs row g-3">

                        <div class="btn-div">
                            <label class="form-label">1) Գործողության բովանդակաություն</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn"></div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="action_qualification_id"
                                    placeholder=""
                                    data-id=""
                                    name="qualification_id"
                                    value="{{$action->qualification_column?->name}}"
                                    tabindex="1"
                                    data-table="action_qualification"
                                    data-model="action_qualification"
                                    list="action_qualification_id"
                                    data-type="update_field"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='organization_category'
                                    data-fieldname='name'
                                ></i>
                                <label for="qualification_id" class="form-label"
                                >2) Գործողության որակավորում<</label>
                            </div>
                            <datalist id="action_qualification_id" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>


                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" placeholder=""
                                       value="{{$action->start_date ? date('Y-m-d', strtotime($action->start_date)) : null }}"
                                       id="start_date" tabindex="2" data-type="update_field"
                                       class="form-control save_input_data" name="start_date" />
                                <label for="start_date" class="form-label"> 3) Գործողության սկիզբ (ամսաթիվ)</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input id="start_date_time" type="time" placeholder=""
                                       value="{{$action->start_date && date('H:i', strtotime($action->start_date)) != '00:00' ? date('H:i', strtotime($action->start_date)) : null }}"
                                       tabindex="3" data-type="update_field" class="form-control save_input_data"
                                       name="start_time" />
                                <label for="start_date_time" class="form-label">4) Գործողության ավարտ (ժամ)</label>
                            </div>
                        </div>



                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" placeholder=""
                                       value="{{$action->end_date ? date('Y-m-d', strtotime($action->end_date)) : null }}"
                                       id="end_date" tabindex="4" data-type="update_field"
                                       class="form-control save_input_data" name="start_date" />
                                <label for="start_date" class="form-label"> 5) Գործողության ավարտ (ամսաթիվ)</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input id="start_date_time" type="time" placeholder=""
                                       value="{{$action->end_date && date('H:i', strtotime($action->end_date)) != '00:00' ? date('H:i', strtotime($action->end_date)) : null }}"
                                       tabindex="5" data-type="update_field" class="form-control save_input_data"
                                       name="end_time" />
                                <label for="start_date_time" class="form-label">6) Գործողության ավարտ (ժամ)</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item6"
                                    placeholder=""
                                    data-id="6"
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
                                <label for="item6" class="form-label"
                                >7) Գործողության տևողությունը</label
                                >
                            </div>
                            <datalist id="brow2" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item7"
                                    placeholder=""
                                    data-id="7"
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
                                <label for="item7" class="form-label"
                                >8) Նպատակը, դրդապատճառը, պատճառը</label
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
                                    id="item8"
                                    placeholder=""
                                    data-id="8"
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
                                <label for="item8" class="form-label"
                                >9) Գործողության կատարման պայմանները</label
                                >
                            </div>
                            <datalist id="brow4" class="input_datalists" style="width: 500px;">

                            </datalist>
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
                                <label for="item9" class="form-label"
                                >10) Իրադարձության (հնարավոր) հետևանքները</label
                                >
                            </div>
                            <datalist id="brow5" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">11) Գործողությունը կապված է գործողության հետ</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn2"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">12) Գործողությունը կապված է իրադարձության հետ</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn3"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">13) Գործողության օբյեկտ (անձ)</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn4"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">14) Գործողության օբյեկտ (Իրադարձություն)</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn5"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">15) Գործողության օբյեկտ (կազմակերպություն)</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn6"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">16) Գործողության օբյեկտ (հեռախոս)</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn7"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">17) Գործողության օբյեկտ (զենք)</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn8"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">17) Գործողության օբյեկտ (ավտոմեքենա)</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn9"></div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item10"
                                    placeholder=""
                                    name="short_desc"
                                />
                                <label for="item10" class="form-label"
                                >19) Տեղեկատվության աղբյուր</label
                                >
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">20) Ստուգվում է որպես ահազանգ</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn10"></div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item11"
                                    placeholder=""
                                    name="short_desc"
                                />
                                <label for="item11" class="form-label"
                                >21) Բացվել է ՕՀԳ</label
                                >
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">22) Հարուցվել է քրեական գործ</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn11"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">23) Գործողության անցկացման վայրը</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv1" id="//btn12">

                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">24) Փաստաթղթի բովանդակութըունը</label>
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
                            <label class="form-label">25) Կապեր</label>
                            <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police"></div>
                        </div>
                        <!-- Vertical Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>

    @section('js-scripts')
        <script>
            let parent_id = "{{ $action->id }}"
            let updated_route = "{{route('action.update',$action->id)}}"
            let delete_item = "{{route('delete_tag')}}"
        </script>
        <script src='{{ asset('assets/js/script.js') }}'></script>
        <script src="{{ asset('assets/js/tag.js') }}"></script>
        <script src="{{ asset('assets/js/error_modal.js') }}"></script>
        <script src='{{ asset('assets/js/action/script.js') }}'></script>
    @endsection
@endsection


