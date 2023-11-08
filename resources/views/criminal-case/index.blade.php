@extends('layouts.auth-app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/criminalCase/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection

@section('content')
<div class="pagetitle-wrapper">
          <div class="pagetitle">
            <h1>Քրեական գործ</h1>
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
            <h5 style="padding: 20px" >ID: 1667</h5>
              <!-- Vertical Form -->
              <form class="form">
                <div class="inputs row g-3">

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="item1"
                      placeholder=""
                      name="short_desc"
                    />
                    <label for="item1" class="form-label"
                      >1) Գործի համար</label
                    >
                  </div>
                </div>

                <div class="btn-div">
                        <label class="form-label">2) Գործը վերաբերում է անձին</label>
                        <a href="//btn1">Ավելացնել</a>
                        <div class="tegs-div" name="tegsDiv2" id="//btn1"></div>
                    </div>

                    <div class="btn-div">
                        <label class="form-label">3) Գործը վերաբերում է Կազմակերպությանը</label>
                        <a href="//btn2">Ավելացնել</a>
                        <div class="tegs-div" name="tegsDiv2" id="//btn2"></div>
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
                      >4) Քրեական գործի հարուցում (ամսաթիվ)</label
                    >
                    <!-- </div> -->
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
                      >5) Քրեական գործի հարուցում Քր․ օր․ հոդված</label
                    >
                  </div>
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
                    <label for="item4" class="form-label"
                      >6) Հարուցվել է վարչության նյութերով</label
                    >
                  </div>
                  <datalist id="brow1" class="input_datalists" style="width: 500px;">

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
                    <label for="item5" class="form-label"
                      >7) Հարուցվել է բաժնի նյութերով</label
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
                      id="item6"
                      placeholder=""
                      data-id="6"
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
                    <label for="item6" class="form-label"
                      >8) Հարուցվել է ստորաբաժանման նյութերով</label
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
                      id="item7"
                      placeholder=""
                      name="short_desc"
                    />
                    <label for="item7" class="form-label"
                      >9) Օ/ա Ա․Հ․Ազգանունը</label
                    >
                  </div>
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
                      >10) Օ/ա պաշտոնը</label
                    >
                  </div>
                  <datalist id="brow4" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="item9"
                      placeholder=""
                      name="short_desc"
                    />
                    <label for="item9" class="form-label"
                      >11) Նյութերի բնույթը (երանգավորում)</label
                    >
                  </div>
                </div>

                <div class="btn-div">
                        <label class="form-label">12) Հարուցվել է փաստով (գործողություն)</label>
                        <a href="//btn3">Ավելացնել</a>
                        <div class="tegs-div" name="tegsDiv2" id="//btn3"></div>
                    </div>

                    <div class="btn-div">
                        <label class="form-label">13) Հարուցվել է փաստով (իրադարձություն)</label>
                        <a href="//btn4">Ավելացնել</a>
                        <div class="tegs-div" name="tegsDiv2" id="//btn4"></div>
                    </div>

                    <div class="btn-div">
                        <label class="form-label">14) Հարուցվել է ահազանգի ստուգման արդյունքները</label>
                        <a href="//btn5">Ավելացնել</a>
                        <div class="tegs-div" name="tegsDiv2" id="//btn5"></div>
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
                          >15) Հարուցվել է ՕՀԳ հիման վրա</label
                        >
                    </div>
                </div>

                <div class="btn-div">
                        <label class="form-label">16) Կազմվել է քրեական գործերից</label>
                        <a href="//btn6">Ավելացնել</a>
                        <div class="tegs-div" name="tegsDiv2" id="//btn6"></div>
                    </div>

                    <div class="btn-div">
                        <label class="form-label">17) Անջատել քրեական գործերից</label>
                        <a href="//btn7">Ավելացնել</a>
                        <div class="tegs-div" name="tegsDiv2" id="//btn7"></div>
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

                </div>
              </form>
              <!-- Vertical Form -->
            </div>
          </div>
        </section>
       
        <x-scroll-up/>
        <x-fullscreen-modal/>
        <x-errorModal/>

@section('js-scripts')
<script src='{{ asset('assets/js/criminalCase/script.js') }}'></script>
@endsection
@endsection
