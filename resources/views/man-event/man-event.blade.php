@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/man-event/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/man-event/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/man-event/style.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Իրադարձություն</h1>
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
                        >1) Իրադարձությունների որակավորում</label
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
                      >2) Իրադարձության ամսաթիվ</label
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
                      >3) Իրադարձության ժամ</label
                    >
                  </div>
                </div>

                <div class="btn-div">
                      <label class="form-label">4) Իրադարձության վայր հասցե</label>
                      <a href="/btn1">Ավելացնել</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn1"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">5) Միջոցառման անցկացման վայրը(կազմակերպություն)</label>
                      <a href="/btn2">Ավելացնել</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn2"></div>
                </div>

                <div class="col">
                        <div class="form-floating">
                        <input
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
                        data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                        data-section = 'get-model-name-in-modal'
                        data-id = 'access_level'
                    ></i>
                        <label for="item4" class="form-label"
                        >6) Իրադարձության (հնարավոր) հետևանքները</label
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
                        >7) Հետաքննությունը հանձնարարված է</label
                        >
                    </div>
                    <datalist id="brow3" class="input_datalists" style="width: 500px;">

                    </datalist>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="item6"
                      placeholder=""
                      name="short_desc"
                    />
                    <label for="item6" class="form-label"
                      >8) Իրադարձության հետաքննության արդյունքները</label
                    >
                  </div>
                </div>

                <div class="btn-div">
                      <label class="form-label">9) Իրադարձությանն առնչություն ունեցող անձինք</label>
                      <a href="/btn3">Ավելացնել</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn3"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">10) Իրադարձությանն առնչություն ունեցող կազմակերպություն</label>
                      <a href="/btn4">Ավելացնել</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn4"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">11) Իրադարձությանն առնչություն ունեցող ավտոմեքենա</label>
                      <a href="/btn5">Ավելացնել</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn5"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">12) Իրադարձությանն առնչություն ունեցող զենք</label>
                      <a href="/btn6">Ավելացնել</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn6"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">13) Իրադարձությանն առնչություն ունեցող գործողություն</label>
                      <a href="/btn7">Ավելացնել</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn7"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">14) Հարուցվել է քրեական գործ</label>
                      <a href="/btn8">Ավելացնել</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn8"></div>
                </div>

                <div class="btn-div">
                      <label class="form-label">15) Ստուգվում է որպես ահազանգ</label>
                      <a href="/btn9">Ավելացնել</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn9"></div>
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
                        >16) Տեղեկատվության աղբյուր</label
                        >
                    </div>
                    <datalist id="brow4" class="input_datalists" style="width: 500px;">

                    </datalist>
                </div>

                <div class="btn-div">
                      <label class="form-label">17) Տվյալ իրադարձությունը կապված է գործողության հետ</label>
                      <a href="/btn10">Ավելացնել</a>
                      <div class="tegs-div" name="tegsDiv2" id="//btn10"></div>
                </div>

                <div class="btn-div">
                    <label class="form-label">18) Փաստաթղթի բովանդակութըունը</label>
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
                    <label class="form-label">19) Կապեր</label>
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
        <script src='{{ asset('assets/js/man-event/script.js') }}'></script>
    @endsection
@endsection


