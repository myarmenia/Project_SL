@extends('layouts.auth-app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/company/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection

@section('content')
<div class="pagetitle-wrapper">
          <div class="pagetitle">
            <h1>Ընկերություն</h1>
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
                      <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                      <label for="inputLastNanme4" class="form-label"
                        >1) Կազմակերպության անվանումը</label
                      >
                    </div>
                  </div>
                  
                  <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item1"
                      placeholder=""
                      data-id="1"
                      value=""
                      name="inp1"
                      list="brow1"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"

                    data-url = ''
                    data-section ='get-bibliography-section-from-modal'
                    data-id=1
                  ></i>
                    <label for="item1" class="form-label"
                      >2) Երկիր</label
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
                      id="inputDate1"
                      class="form-control"
                      placaholder=""
                      name="inp6"
                    />
                    <label for="inputDate1" class="form-label"
                      >3) Հիմնադրման ամսաթիվ գրանցում</label
                    >
                    <!-- </div> -->
                  </div>
                </div>

                <div class="btn-div">
                    <label class="form-label">4) Կազմակերպության, շտաբի գրասենյակի գտնվելու վայրը (հասցե)</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-addres"></div>
                  </div>

                  <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item2"
                      placeholder=""
                      data-id="2"
                      value=""
                      name="inp2"
                      list="brow2"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"

                    data-url = ''
                    data-section ='get-bibliography-section-from-modal'
                    data-id=2
                  ></i>
                    <label for="item2" class="form-label"
                      >5) Գործունեության տարածաշրջան</label
                    >
                  </div>
                    <datalist id="brow2" class="input_datalists" style="width: 500px;">

                    </datalist>
                </div>

                <div class="btn-div">
                    <label class="form-label">6) Հայտնի է նաև որպես</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-nickName"></div>
                  </div>

                  <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item3"
                      placeholder=""
                      data-id="3"
                      value=""
                      name="inp3"
                      list="brow3"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"

                    data-url = ''
                    data-section ='get-bibliography-section-from-modal'
                    data-id=3
                  ></i>
                    <label for="item3" class="form-label"
                      >7) Կազմակերպության կատեգորիա</label
                    >
                  </div>

                  <datalist id="brow3" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>
                
                <div class="btn-div">
                    <label class="form-label">8) Հեռախոսահամար</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-phone"></div>
                  </div>

                  <div class="btn-div">
                    <label class="form-label">9) Էլեկտրոնային հասցե (e-mail)</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-email"></div>
                  </div>

                  <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item4"
                      placeholder=""
                      data-id="4"
                      value=""
                      name="inp4"
                      list="brow4"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"

                    data-url = ''
                    data-section ='get-bibliography-section-from-modal'
                    data-id=4
                  ></i>
                    <label for="item4" class="form-label"
                      >10) Ստորաբաժանում, որն աշխատել է կազմակերպությամբ</label
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
                        id="item5"
                        placeholder=""
                        name="inp5"
                      />
                      <label for="item5" class="form-label"
                        >11) Աշխատողների կամ անդամների քանակ</label
                      >
                    </div>
                  </div>
                  
                  <div class="btn-div">
                    <label class="form-label">12) Իրադարձություն</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-event"></div>
                  </div>

                  <div class="btn-div">
                    <label class="form-label">13) Կապն այլ կազմակերպությունների հետ</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-liaison"></div>
                  </div>

                  <div class="col">
                    <div class="form-floating">
                      <input
                        type="text"
                        class="form-control"
                        id="item6"
                        placeholder=""
                        name="inp6"
                      />
                      <label for="item6" class="form-label"
                        >14) Ուշադրություն!</label
                      >
                    </div>
                  </div>

                  <div class="btn-div">
                    <label class="form-label">15) Կեղծ հասցե</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-fakeAddress"></div>
                  </div>

                  <div class="col">
                    <div class="form-floating">
                      <input
                        type="text"
                        class="form-control"
                        id="item7"
                        placeholder=""
                        name="inp7"
                      />
                      <label for="item7" class="form-label"
                        >16) Կազմակերպության նկատմամբ բացվել է ՕՀԳ</label
                      >
                    </div>
                  </div>

                  <div class="btn-div">
                    <label class="form-label">17) Անցնում է քրեական գործով</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-criminalCase"></div>
                  
                </div>
                
                <div class="btn-div">
                    <label class="form-label">18) Գործողության օբյեկտ</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-objectOfAction"></div>
                  
                </div>

                <div class="btn-div">
                    <label class="form-label">19) Անձի աշխատավայր</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-personsWorkplace"></div>
                  </div>
                
                  <div class="btn-div">
                    <label class="form-label">20) Ստուգվում է ահազանգով</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-CheckedAlarm"></div>
                </div>

                <div class="btn-div">
                    <label class="form-label">21) Անցնում է ահազանգով</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-PassesAlarm"></div>
                </div>

                <div class="btn-div">
                    <label class="form-label">22) Ավտոմեքենայի առկայություն</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-car"></div>
                </div>

                <div class="btn-div">
                    <label class="form-label">23) Զենքի առկայություն</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-gun"></div>
                </div>

                <div class="btn-div">
                    <label class="form-label">24) Անցում ոստիկանության ամփոփագրով</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-police"></div>
                </div>

                <div class="btn-div">
                    <label class="form-label">25) Իրադարձության վայրը (հասցե)</label>
                    <a href="#">Ավելացնել</a>
                    <div class="tegs-div" name="tegsDiv1" id="company-police"></div>
                </div>

                <div class="btn-div">
                    <label class="form-label">26) Փաստաթղթի բովանդակութըունը</label>
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
                    <label class="form-label">27) Կապեր</label>
                    <div class="tegs-div" name="tegsDiv1" id="company-police"></div>
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
<script src='{{ asset('assets/js/company/script.js') }}'></script>
@endsection
@endsection
