@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/action/style.css') }}">
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

                    <div class="btn-div">
                        <label class="form-label">1) {{__('content.content_materials_actions')}}</label>
                        <a href="/btn2">{{__('content.addTo')}}</a>
                        <div class="tegs-div" name="tegsDiv2" id="//btn">
                          <div class="tegs-div-content"></div>
                        </div>
                    </div>

                    <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title outline-red"
                      id="item1"
                      placeholder=""
                      data-id="1"
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
                    <label for="item1" class="form-label"
                      >2) {{__('content.qualification_fact')}}</label
                    >
                  </div>
                  <datalist id="brow1" class="input_datalists" style="width: 500px;">

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
                      id="item2"
                      class="form-control calendarInput"
                      placaholder=""
                      name="inp2"
                      data-check="date"
                      autocomplete="off" onblur="handleBlur(this)"
                    />
                    <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>
                    <label for="item2" class="form-label"
                      >3) {{__('content.start_action_date')}}</label
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
                      name="short_desc"
                    />
                    <label for="item3" class="form-label"
                      >4) {{__('content.start_action_time')}}</label
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
                      id="item4"
                      class="form-control calendarInput"
                      placaholder=""
                      name="inp2"
                      data-check="date"
                      autocomplete="off" onblur="handleBlur(this)"
                    />
                    <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>
                    <label for="item4" class="form-label"
                      >5) {{__('content.end_action_date')}}</label
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
                      name="short_desc"
                    />
                    <label for="item5" class="form-label"
                      >6) {{__('content.end_action_time')}}</label
                    >
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
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = 'get-model-name-in-modal'
                    data-id = 'access_level'
                  ></i>
                    <label for="item6" class="form-label"
                      >7) {{__('content.duration_action')}}</label
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
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = 'get-model-name-in-modal'
                    data-id = 'access_level'
                  ></i>
                    <label for="item7" class="form-label"
                      >8) {{__('content.purpose_motive_reason')}}</label
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
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = 'get-model-name-in-modal'
                    data-id = 'access_level'
                  ></i>
                    <label for="item8" class="form-label"
                      >9) {{__('content.terms_actions')}}</label
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
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = 'get-model-name-in-modal'
                    data-id = 'access_level'
                  ></i>
                    <label for="item9" class="form-label"
                      >10) {{__('content.start_action_date')}}</label
                    >
                  </div>
                  <datalist id="brow5" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="btn-div">
                      <label class="form-label">11) {{__('content.action_related_event_action')}}</label>
                      <a href="/btn2">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn2"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">12) {{__('content.action_related_event_event')}}</label>
                      <a href="/btn2">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn3"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">13) {{__('content.object_action_man')}}</label>
                      <a href="/btn2">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn4"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">14) {{__('content.object_action_event')}}</label>
                      <a href="/btn2">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn5"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">15) {{__('content.object_action_organization')}}</label>
                      <a href="/btn2">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn6"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">16) {{__('content.object_action_phone')}}</label>
                      <a href="/btn2">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn7"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">17) {{__('content.object_action_weapon')}}</label>
                      <a href="/btn2">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn8"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">17) {{__('content.object_action_car')}}</label>
                      <a href="/btn2">{{__('content.addTo')}}</a>
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
                      >19) {{__('content.source_category')}}</label
                    >
                  </div>
                </div>

                <div class="btn-div">
                      <label class="form-label">20) {{__('content.checking_signal')}}</label>
                      <a href="/btn2">{{__('content.addTo')}}</a>
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
                      >21) {{__('content.opened_dou')}}</label
                    >
                  </div>
                </div>

                <div class="btn-div">
                      <label class="form-label">22) {{__('content.criminal_case')}}</label>
                      <a href="/btn2">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn11"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">23) {{__('content.place_action')}}</label>
                      <a href="#">{{__('content.addTo')}}</a>
                      <div class="tegs-div" name="tegsDiv1" id="//btn12">

                      </div>
                </div>

                <div class="btn-div">
                    <label class="form-label">24) {{__('content.contents_document')}}</label>
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
                    <label class="form-label">25) {{__('content.ties')}}</label>
                    <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police">

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
        <script src='{{ asset('assets/js/action/script.js') }}'></script>
      <script src='{{ asset('assets/js/main/date.js') }}'></script>

    @endsection
@endsection


