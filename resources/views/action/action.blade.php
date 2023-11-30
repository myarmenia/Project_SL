@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/action/style.css') }}">
@endsection

@section('content')

    <x-breadcrumbs :title="__('content.action')" />
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <p> id: 555</p>

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
                    style='outline:3px solid red;'
                      type="text"
                      class="form-control fetch_input_title"
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
                      >2) Գործողության որակավորում</label
                    >
                  </div>
                  <datalist id="brow1" class="input_datalists" style="width: 500px;">

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
                      id="item2"
                      class="form-control"
                      placaholder=""
                      name="inp2"
                    />
                    <label for="item2" class="form-label"
                      >3) Գործողության սկիզբ (ամսաթիվ)</label
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
                      >4) Գործողության սկիզբ (ժամ)</label
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
                      id="item4"
                      class="form-control"
                      placaholder=""
                      name="inp2"
                    />
                    <label for="item4" class="form-label"
                      >5) Գործողության ավարտ (ամսաթիվ)</label
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
                      >6) Գործողության ավարտ (ժամ)</label
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
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = 'get-model-name-in-modal'
                    data-id = 'access_level'
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
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = 'get-model-name-in-modal'
                    data-id = 'access_level'
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
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = 'get-model-name-in-modal'
                    data-id = 'access_level'
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
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>

    @section('js-scripts')
        <script src='{{ asset('assets/js/action/script.js') }}'></script>
    @endsection
@endsection


