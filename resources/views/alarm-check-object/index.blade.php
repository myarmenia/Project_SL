@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/alarm/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
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
                        <div class="form-floating">
                        <input
                        type="text"
                        class="form-control outline-red"
                        id="item1"
                        placeholder=""
                        name="short_desc"
                        />
                        <label for="item1" class="form-label"
                        >1) {{__('content.reg_number_signal')}}</label
                        >
                    </div>
                </div>

                <div class="btn-div">
                      <label class="form-label">2) {{__('content.contents_information_signal')}}</label>
                      <a href="/btn1">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn1"> <div class="tegs-div-content"></div></div>
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
                        >3) {{__('content.line_which_verified')}}</label
                        >
                    </div>
                </div>

                <div class="btn-div">
                      <label class="form-label">4) {{__('content.check_status_charter')}}</label>
                      <a href="/btn2">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn2"></div>
                </div>

                <div class="col">
                        <div class="form-floating">
                        <input
                        type="text"
                        class="form-control fetch_input_title outline-red"
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item3" class="form-label"
                        >5) {{__('content.qualifications_signaling')}}</label
                        >
                    </div>
                    <datalist id="brow1" class="input_datalists" style="width: 500px;">

                    </datalist>
                </div>

                <div class="col">
                        <div class="form-floating">
                        <input
                        type="text"
                        class="form-control fetch_input_title outline-red"
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item4" class="form-label"
                        >6) {{__('content.source_category')}}</label
                        >
                    </div>
                    <datalist id="brow2" class="input_datalists" style="width: 500px;">

                    </datalist>
                </div>

                <div class="col">
                        <div class="form-floating">
                        <input
                        type="text"
                        class="form-control fetch_input_title outline-red"
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item5" class="form-label"
                        >7) {{__('content.checks_signal')}}</label
                        >
                    </div>
                    <datalist id="brow3" class="input_datalists" style="width: 500px;">

                    </datalist>
                </div>

                <div class="col">
                        <div class="form-floating">
                        <input
                        type="text"
                        class="form-control fetch_input_title outline-red"
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item6" class="form-label"
                        >8) {{__('content.department_checking')}}</label
                        >
                    </div>
                    <datalist id="brow4" class="input_datalists" style="width: 500px;">

                    </datalist>
                </div>

                <div class="col">
                        <div class="form-floating">
                        <input
                        type="text"
                        class="form-control fetch_input_title outline-red"
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item7" class="form-label"
                        >9) {{__('content.unit_testing')}}</label
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
                        >10) {{__('content.name_checking_signal')}}</label
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item9" class="form-label"
                        >11) {{__('content.report_3')}}</label
                        >
                    </div>
                    <datalist id="brow6" class="input_datalists" style="width: 500px;">

                    </datalist>
                </div>

                <div class="col">
                  <div class="form-floating input-date-wrapper calendar-container">
                    <!-- <div class="input-date-wrapper"> -->
                    <!-- <label for="inputDate1" role="value"></label>
                    <input type="text" hidden role="store" /> -->
                    <input
                      type="text"
                      placeholder=""
                      id="item10"
                      class="form-control outline-red calendarInput"
                      placaholder=""
                      name="inp10"
                      data-check="date"
                      autocomplete="off" onblur="handleBlur(this)"
                    />
                    <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>
                    <label for="item10" class="form-label"
                      >12) {{__('content.date_registration_division')}}</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating input-date-wrapper calendar-container">
                    <!-- <div class="input-date-wrapper"> -->
                    <!-- <label for="inputDate1" role="value"></label>
                    <input type="text" hidden role="store" /> -->
                    <input
                      type="text"
                      placeholder=""
                      id="item11"
                      class="form-control outline-red calendarInput"
                      placaholder=""
                      name="inp11"
                      data-check="date"
                      autocomplete="off" onblur="handleBlur(this)"
                    />
                    <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>
                    <label for="item11" class="form-label"
                      >13) {{__('content.check_date')}}</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating input-date-wrapper calendar-container">
                    <!-- <div class="input-date-wrapper"> -->
                    <!-- <label for="inputDate1" role="value"></label>
                    <input type="text" hidden role="store" /> -->
                    <input
                      type="text"
                      placeholder=""
                      id="item12"
                      class="form-control calendarInput"
                      placaholder=""
                      name="inp12"
                      data-check="date"
                      autocomplete="off" onblur="handleBlur(this)"
                    />
                    <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>
                    <label for="item12" class="form-label"
                      >14) {{__('content.check_previously')}}</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating input-date-wrapper calendar-container">
                    <!-- <div class="input-date-wrapper"> -->
                    <!-- <label for="inputDate1" role="value"></label>
                    <input type="text" hidden role="store" /> -->
                    <input
                      type="text"
                      placeholder=""
                      id="item13"
                      class="form-control calendarInput"
                      placaholder=""
                      name="inp13"
                      data-check="date"
                      autocomplete="off" onblur="handleBlur(this)"
                    />
                    <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>
                    <label for="item13" class="form-label"
                      >15) {{__('content.date_actual')}}</label
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
                        >16) {{__('content.amount_overdue')}}</label
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item15" class="form-label"
                        >17) {{__('content.useful_capabilities')}}</label
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item16" class="form-label"
                        >18) {{__('content.signal_results')}}</label
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item17" class="form-label"
                        >19) {{__('content.measures_taken')}}</label
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
                        >20) {{__('content.according_result_dow')}}</label
                        >
                    </div>
                </div>

                <div class="btn-div">
                      <label class="form-label">21) {{__('content.according_test_result')}}</label>
                      <a href="/btn3">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn3"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">22) {{__('content.objects_check_signal_man')}}</label>
                      <a href="/btn4">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn4"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">23) {{__('content.objects_check_signal_organization')}}</label>
                      <a href="/btn5">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn5"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">24) {{__('content.objects_check_signal_action')}}</label>
                      <a href="/btn6">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn6"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">25) {{__('content.objects_check_signal_event')}}</label>
                      <a href="/btn7">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn7"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">26) {{__('content.passes_signal')}}</label>
                      <a href="/btn8">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn8"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">27) {{__('content.passes_signal_organization')}}</label>
                      <a href="/btn9">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn9"></div>
                </div>

                <div class="col">
                        <div class="form-floating">
                        <input
                        type="text"
                        class="form-control fetch_input_title outline-red"
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item19" class="form-label"
                        >28) {{__('content.brought_signal')}}</label
                        >
                    </div>
                    <datalist id="brow10" class="input_datalists" style="width: 500px;">

                    </datalist>
                </div>

                <div class="col">
                        <div class="form-floating">
                        <input
                        type="text"
                        class="form-control fetch_input_title outline-red"
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item20" class="form-label"
                        >29) {{__('content.department_brought')}}</label
                        >
                    </div>
                    <datalist id="brow11" class="input_datalists" style="width: 500px;">

                    </datalist>
                </div>

                <div class="col">
                        <div class="form-floating">
                        <input
                        type="text"
                        class="form-control fetch_input_title outline-red"
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item21" class="form-label"
                        >30) {{__('content.unit_brought')}}</label
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
                        >31) {{__('content.name_operatives')}}</label
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item23" class="form-label"
                        >32) {{__('content.worker_post')}}</label
                        >
                    </div>
                    <datalist id="brow13" class="input_datalists" style="width: 500px;">

                    </datalist>
                </div>

                <div class="btn-div">
                      <label class="form-label">33) {{__('content.keep_signal')}}</label>
                      <a href="/btn10">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn10"></div>
                </div>


                <div class="btn-div">
                    <label class="form-label">34) {{__('content.contents_document')}}</label>
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
                    <label class="form-label">35) {{__('content.ties')}}</label>
                    <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police"></div>
                </div>

                <!-- Vertical Form -->
            </div>
        </div>
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>



    @section('js-scripts')
        <script src='{{ asset('assets/js/alarm/script.js') }}'></script>
        <script src='{{ asset('assets/js/main/date.js') }}'></script>
    @endsection
@endsection


