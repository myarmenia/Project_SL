@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/bibliography/style.css') }}">
@endsection
@inject('carbon', 'Carbon\Carbon')

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
<<<<<<< HEAD
          <h1>Նյութ</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active">Նյութ</li>
              <li class="breadcrumb-item active">ID:{{$data->id}}</li>
            </ol>
          </nav>
=======
            <h1>Նյութ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Նյութ</li>
                    <li class="breadcrumb-item active">ID:{{ $getbibliography->id }}</li>
                </ol>
            </nav>
>>>>>>> 2a325228caafa6b20b3122fd397a0e0e51b5060c
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">


                <!-- Vertical Form -->
                <form class="form">
                    <div class="inputs row g-3">


                        <div class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class">
                            <span class="form-label">Մուտքագրման ամսաթիվ</span>

<<<<<<< HEAD
                <span>
                    {{$carbon::parse( $data->created_at)->format('Y-m-d') }}
=======
                            <span>
                                {{ $carbon::parse($getbibliography->created_at)->format('Y-m-d') }}
>>>>>>> 2a325228caafa6b20b3122fd397a0e0e51b5060c

                            </span>
                        </div>

                        <div class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class">
                            <span class="form-label">Մուտքագրման Ժամ</span>

<<<<<<< HEAD
                <span>
                    {{-- 11։05։56 --}}
                    {{$carbon::parse( $data->created_at)->format('H:i:s') }}
                </span>
                </div>
                <!-- To open modal """fullscreenModal""" -->

                <input type="hidden" class="form-control "  name="bibliography_id" value="{{$data->id}}" >
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item1"
                      placeholder=""
                      data-id="1"
                      value=""
                      name="from_agency_id"

                      list="brow1"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url = '{{route('get-model-filter',['path'=>'agency'])}}'
                    data-section = '{{route('open.modal')}}'
                    data-id='agency'
                    data-fieldname ='name'
                  ></i>
                    <label for="item1" class="form-label"
                      >1) Տեղեկատվություն տրամադրող մարմին</label
                    >
                  </div>

                  <datalist id="brow1" class="input_datalists" style="width: 500px;">
                    <option>aaaaa</option>
                  </datalist>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item2"
                      placeholder=""
                      data-id="2"
                      name="category_id"
                      list="brow2"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url = '{{route('get-model-filter',['path'=>'doc_category'])}}'
                    data-section = '{{route('open.modal')}}'
                    data-fieldname ='name'
                    data-id='doc_category'
                  ></i>
                    <label for="item2" class="form-label"
                      >2) Փաստաթղթի կատեգորիա</label
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
                      id="item3"
                      placeholder=""
                      data-id="3"
                      name="access_level_id"
                      list="brow3"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = '{{route('open.modal')}}'
                    data-fieldname ='name'
                    data-id = 'access_level'
                  ></i>
                    <label for="item3" class="form-label"
                      >3) Մուտքի մակարդակ</label
                    >
                  </div>
                  <datalist id="brow3" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <!-- Date Input -->
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="inputDate2"
                      placeholder=""
                      name="user_id"
                      value={{$data->users->username}}
                    />
                    <label for="inputDate2" class="form-label"
                      >4) Փաստաթուղթը մուտքագրող օ/ա</label
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
                      name="reg_number"
                    />
                    <label for="inputDate2" class="form-label"
                      >5) Փաստաթուղթը գրանցման համար</label
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
                      placaholder=""
                      name="reg_date"
                    />
                    <label for="inputDate1" class="form-label"
                      >6) Գրանցման ամսաթիվ</label
                    >
                    <!-- </div> -->
                  </div>
                </div>
                <!-- Inputs -->

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="inputDate2"
                      placeholder=""
                      name="worker_name"
                    />
                    <label for="inputDate2" class="form-label"
                      >7) Փաստաթուղթն ստացող օ/ա</label
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
                      name="source_agency_id"
                      list="brow5"

                    />
                    <i
                    class="i class=bi bi-hr icon icon-base my-plus-class"
                    data-url = '{{route('get-model-filter',['path'=>'agency'])}}'
                    data-section = '{{route('open.modal')}}'
                    data-fieldname ='name'
                    data-id='agency'
                  ></i>
                    <label for="inputDate2" class="form-label"
                      >8) Ստորաբաժանում, որտեղ պահվում են նախնական նյութեր</label
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
                      id="inputDate2"
                      placeholder=""
                      name="source_address"
                    />
                    <label for="inputDate2" class="form-label"
                      >9) Նաղնական նյութերի պահպանման տեղ</label
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
                      name="short_desc"
                    />
                    <label for="inputDate2" class="form-label"
                      >10) Փաստաթղթի համառոտ բովանդակություն</label
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
                      name="related_year"
                    />
                    <label for="inputDate2" class="form-label"
                      >11) Տեղեկությունը վերաբերվում է ․․․թ</label
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
                      name="source"
                    />
                    <label for="inputDate2" class="form-label"
                      >12) Տեղեկության աղբյուր</label
                    >
                  </div>
                </div>

                <div class="col">
                    {{-- appending tags --}}
                   <div class="tegs-div">

                    </div>
                  <div class="form-floating">

                    <input
                      type="text"
                      class="form-control fetch_input_title teg_class"
                      id="item4"
                      placeholder=""
                      data-id="4"
                      name="country_id"
                      list="brow4"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url = '{{route('get-model-filter',['path'=>'country'])}}'
                    data-section = '{{route('open.modal')}}'
                    data-id='country'
                    data-fieldname ='name'
                  ></i>
                    <label for="item4" class="form-label"
                      >13) Երկիր, որին վերաբերում է տեղեկությունը</label
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
                      id="inputDate2"
                      placeholder=""
                      name="theme"
                    />
                    <label for="inputDate2" class="form-label"
                      >14) Թեմատիկայի անվանումը</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="inputPassportNumber1"
                      placeholder=""
                      name="title"

                    />
                    <label for="inputPassportNumber1" class="form-label"
                      >15) Փաստաթղթի Վերնագիրը</label
                    >
                  </div>
                </div>

                <div class="btn-div">
                    <div>
                    <label class="form-label">16) Փաստաթղթի բովանդակություն</label>
                    <input
                        id="file_id_word"
                        type="file"
                        name="file"
                        data-href-type=""
                        class="file-upload"
                        data-render-type="none"
                        hidden
                        accept=".doc,.docx,video/mp4,video/x-m4v,video/*"

                        />
                        <input id="hiddenInp" type="hidden">
                        <label for="file_id_word" class="file-upload-btn btn btn-secondary h-fit w-fit upload_btn">
                          Բեռնել
                        </label>
                    </div>

                        <div class="files">
                            <div class="newfile">
=======
                            <span>
                                {{-- 11։05։56 --}}
                                {{ $carbon::parse($getbibliography->created_at)->format('H:i:s') }}
                            </span>
                        </div>
                        <!-- To open modal """fullscreenModal""" -->
>>>>>>> 2a325228caafa6b20b3122fd397a0e0e51b5060c

                        <input type="hidden" class="form-control " name="bibliography_id"
                            value="{{ $getbibliography->id }}">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title" id="item1" placeholder=""
                                    data-id="1" value="" name="from_agency_id" list="brow1" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{ route('get-model-filter', ['path' => 'agency']) }}'
                                    data-section='get-model-name-in-modal' {{-- data-id='1' --}} data-id='agency'></i>
                                <label for="item1" class="form-label">1) Տեղեկատվություն տրամադրող մարմին</label>
                            </div>
<<<<<<< HEAD
                            {{-- <div id='fileeHom' class="file-upload-content tegs-div">
                              <div class="Myteg">
                                <span><a href="">dddd</a></span>
                                <span>X</span>
                              </div>
                              <div class="Myteg">
                                <span><a href="">ffff</a></span>
                                <span>X</span>
                              </div>
                            </div> --}}
=======

                            <datalist id="brow1" class="input_datalists" style="width: 500px;">
                                <option>aaaaa</option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title" id="item2" placeholder=""
                                    data-id="2" name="category_id" list="brow2" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{ route('get-model-filter', ['path' => 'doc_category']) }}'
                                    data-section='get-model-name-in-modal' {{-- data-id=2 --}} data-id='doc_category'></i>
                                <label for="item2" class="form-label">2) Փաստաթղթի կատեգորիա</label>
                            </div>
                            <datalist id="brow2" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title" id="item3" placeholder=""
                                    data-id="3" name="access_level_id" list="brow3" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{ route('get-model-filter', ['path' => 'access_level']) }}'
                                    data-section='get-model-name-in-modal' data-id='access_level'></i>
                                <label for="item3" class="form-label">3) Մուտքի մակարդակ</label>
                            </div>
                            <datalist id="brow3" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <!-- Date Input -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputDate2" placeholder="" name="inp4" />
                                <label for="inputDate2" class="form-label">4) Փաստաթուղթը մուտքագրող օ/ա</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputDate2" placeholder="" name="inp5" />
                                <label for="inputDate2" class="form-label">5) Փաստաթուղթը գրանցման համար</label>
                            </div>
>>>>>>> 2a325228caafa6b20b3122fd397a0e0e51b5060c
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <!-- <div class="input-date-wrapper"> -->
                                <!-- <label for="inputDate1" role="value"></label>
                                <input type="text" hidden role="store" /> -->
                                <input type="date" placeholder="" id="inputDate1" class="form-control"
                                    placaholder="" name="inp6" />
                                <label for="inputDate1" class="form-label">6) Գրանցման ամսաթիվ</label>
                                <!-- </div> -->
                            </div>
                        </div>
                        <!-- Inputs -->

<<<<<<< HEAD
                <div class="form-check my-formCheck-class">
                  <!-- <input class="form-check-input form-control" type="checkbox" id="checkAll" name="hasVideo" disabled/> -->
                  <i class="bi bi-check-lg"></i>
                </div>
                </div>
                  <h6>ԱՆՁ (ՔԱՆԱԿԸ) ։ 0</h6>
                <div class="col">
                  <div class="form-floating">
                    <select class="form-select form-control" name="selectInfo">
                      <option selected disabled value="" hidden></option>
                      <option value="1">Անձ</option>
                      <option value="1">Կազմակերպություն</option>
                      <option value="1">Իրադարձություն</option>
                      <option value="1">Ահազանգ</option>
                      <option value="1">Քրեական գործ</option>
                      <option value="1">Գործողություն</option>
                      <option value="1">Վերահսկում</option>
                      <option value="1">Ոստիկանության վիճակագրություն</option>
                      <option value="1">Վիճակագրության ավելացում ինքնաաշխատ եղանակով</option>
                      <option value="1">Վիճակագրության  անձերի աղյուսակների ավելացում ինքնաաշխատ եղանակով</option>
                    </select>
                    <label class="form-label"
                      >18) Պարունակում է տեղեկատվություն</label
                    >
                  </div>
                </div>
=======
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputDate2" placeholder=""
                                    name="inp7" />
                                <label for="inputDate2" class="form-label">7) Փաստաթուղթն ստացող օ/ա</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputDate2" placeholder=""
                                    name="inp8" />
                                <label for="inputDate2" class="form-label">8) Ստորաբաժանում, որտեղ պահվում են նախնական
                                    նյութեր</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputDate2" placeholder=""
                                    name="inp9" />
                                <label for="inputDate2" class="form-label">9) Նաղնական նյութերի պահպանման տեղ</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputDate2" placeholder=""
                                    name="short_desc" />
                                <label for="inputDate2" class="form-label">10) Փաստաթղթի համառոտ բովանդակություն</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputDate2" placeholder=""
                                    name="related_year" />
                                <label for="inputDate2" class="form-label">11) Տեղեկությունը վերաբերվում է ․․․թ</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputDate2" placeholder=""
                                    name="source" />
                                <label for="inputDate2" class="form-label">12) Տեղեկության աղբյուր</label>
                            </div>
                        </div>

                        <div class="col">
                            {{-- appending tags --}}
                            <div class="tegs-div">

                            </div>
                            <div class="form-floating">

                                <input type="text" class="form-control fetch_input_title teg_class" id="item4"
                                    placeholder="" data-id="4" name="country_id" list="brow4" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url='{{ route('get-model-filter', ['path' => 'country']) }}'
                                    data-section='get-model-name-in-modal' {{-- data-id=4 --}} data-id='country'></i>
                                <label for="item4" class="form-label">13) Երկիր, որին վերաբերում է
                                    տեղեկությունը</label>
                            </div>

                            <datalist id="brow4" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputDate2" placeholder=""
                                    name="theme" />
                                <label for="inputDate2" class="form-label">14) Թեմատիկայի անվանումը</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputPassportNumber1" placeholder=""
                                    name="title" />
                                <label for="inputPassportNumber1" class="form-label">15) Փաստաթղթի Վերնագիրը</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <div>
                                <label class="form-label">16) Փաստաթղթի բովանդակություն</label>
                                <input id="file_id_word" type="file" name="file" data-href-type=""
                                    class="file-upload" data-render-type="none" hidden accept=".doc,.docx" />
                                <label for="file_id_word"
                                    class="file-upload-btn btn btn-secondary h-fit w-fit upload_btn">
                                    Բեռնել
                                </label>
                            </div>

                            <div class="files">
                                <div class="newfile">

                                </div>
                                <div id='fileeHom' class="file-upload-content tegs-div">
                                    <div class="Myteg">
                                        <span><a href="">dddd</a></span>
                                        <span>X</span>
                                    </div>
                                    <div class="Myteg">
                                        <span><a href="">ffff</a></span>
                                        <span>X</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class">
                            <span class="form-label">17) Վիդեեյի առկայություն</span>

                            <div class="form-check my-formCheck-class">
                                <input class="form-check-input" type="checkbox" id="checkAll" name="hasVideo" />
                            </div>
                        </div>
                        <h6>ԱՆՁ (ՔԱՆԱԿԸ) ։ 0</h6>
                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select form-control" name="selectInfo" id="selectOption">
                                    <option selected disabled value="" hidden></option>
                                    <option value="1">Անձ</option>
                                    <option value="1">Կազմակերպություն</option>
                                    <option value="1">Իրադարձություն</option>
                                    <option value="1">Ահազանգ</option>
                                    <option value="1">Քրեական գործ</option>
                                    <option value="1">Գործողություն</option>
                                    <option value="1">Վերահսկում</option>
                                    <option value="1">Ոստիկանության վիճակագրություն</option>
                                    <option value="Statistics">Վիճակագրության ավելացում ինքնաաշխատ եղանակով</option>
                                    <option value="1">Վիճակագրության անձերի աղյուսակների ավելացում ինքնաաշխատ եղանակով
                                    </option>
                                </select>
                                <label class="form-label">18) Պարունակում է տեղեկատվություն</label>
                            </div>
                        </div>
>>>>>>> 2a325228caafa6b20b3122fd397a0e0e51b5060c



                    </div>

                    <!-- ######################################################## -->
                    <!-- Submit button -->
                    <!-- ######################################################## -->
                </form>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- ########################################################################### -->
    <!-- ############################## Modals #################################### -->
    <!-- ########################################################################### -->

    <!-- fullscreenModal -->
    <div class="modal fade my-modal" id="fullscreenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
<<<<<<< HEAD
            <div class="modal-header">
                <form id="addNewInfoBtn">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="addNewInfoInp"
                            name="name"
                            placeholder=""
                        />
                        <label for="item21" class="form-label"
                        >Ֆիլտրացիա</label
                        >
                    </div>
                    <table id="filter_content">
=======
                <div class="modal-header">
                    <form id="addNewInfoBtn">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="addNewInfoInp" placeholder="" />
                            <label for="item21" class="form-label">Ֆիլտրացիա</label>
                        </div>
                        <table id="filter_content">
>>>>>>> 2a325228caafa6b20b3122fd397a0e0e51b5060c

                        </table>

                        <button type="submit" class="btn btn-primary">Ավելացնել նոր գրանցում</button>
                    </form>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="numbering" scope="col">#</th>
                                <th scope="col">Անվանում</th>
                                <th scope="col" class="td-xs"></th>
                            </tr>
                        </thead>
                        <tbody id="table_id">
                            {{-- @foreach ($agency as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td class="inputName">{{$item->name}}</td>
                                    <td>
                                    <button type="button" class="addInputTxt btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Ավելացնել</button>
                                    </td>
                                </tr>

                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="errModal" class="error-modal">
        <div class="error-modal-info">
            <p>soryyyyyy</p>
            <button type="button" class="addInputTxt_error btn btn-primary my-close-error">Լավ</button>
        </div>
    </div>

@section('js-scripts')
    <script>
<<<<<<< HEAD
        let url_id="{{$data->id}}"
        let table_name="{{$table_name}}"
console.log(table_name);
 </script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/tag.js') }}"></script>

=======
        let url_id = "{{ $getbibliography->id }}"
        let table_name = "{{ $table_name }}"
        console.log(table_name);
        document.getElementById('selectOption').addEventListener('change', function(el) {
            // console.log(el, el.target.value, 8888888888);
            if (el.target.value === "Statistics") {
              window.location.href = "{{ route('bibliography.summery_automatic') }}";
            }
        })
    </script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/tag.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/bibliography/script.js') }}"></script> -->
>>>>>>> 2a325228caafa6b20b3122fd397a0e0e51b5060c
@endsection
@endsection
