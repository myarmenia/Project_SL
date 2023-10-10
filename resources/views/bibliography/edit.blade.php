@extends('layouts.auth-app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/bibliography/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/error.css') }}">
@endsection
@inject('carbon', 'Carbon\Carbon')

@section('content')

<div class="pagetitle-wrapper">
        <div class="pagetitle">
          <h1>Նյութ</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active">Նյութ</li>
              <li class="breadcrumb-item active">ID:{{$bibliography->id}}</li>
            </ol>
          </nav>
        </div>
</div>
      <!-- End Page Title -->

      <section class="section">
        <div class="card">
          <div class="card-body">


            <!-- Vertical Form -->
            <form class="form">
              <div class="inputs row g-3">


                <div
                class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class"
                >
                <span class="form-label">Մուտքագրման ամսաթիվ</span>

                <span>
                    {{$carbon::parse( $bibliography->created_at)->format('Y-m-d') }}

                </span>
                </div>

                <div
                class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class"
                >
                <span class="form-label">Մուտքագրման Ժամ</span>

                <span>
                    {{-- 11։05։56 --}}
                    {{$carbon::parse( $bibliography->created_at)->format('H:i:s') }}
                </span>
                </div>
                <!-- To open modal """fullscreenModal""" -->

                <input type="hidden" class="form-control "  name="bibliography_id" value="{{$bibliography->id}}" >
                <div class="col">
                  <div class="form-floating">
                    {{-- {{dd($bibliography->agency)}} --}}
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item1"
                      placeholder=""
                      data-id="1"
                      value="{{$bibliography->agency->name ?? null }}"
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
                      value="{{ $bibliography->doc_category->name ?? null }}"
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
                      value="{{ $bibliography->access_level->name ?? null}}"
                      data-update="{{route('bibliography.update',$bibliography->id)}}"
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
                      value={{$bibliography->users->username}}
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
                      value="{{ $bibliography->reg_number ?? null }}"
                      data-update="{{ route('bibliography.update', $bibliography->id )}}"
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
                      value="{{$bibliography->reg_date ?? null}}"
                      data-update="{{ route('bibliography.update',$bibliography->id )}}"
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
                      value="{{ $bibliography->worker_name ?? null}}"

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
                      class="form-control fetch_input_title"
                      id="inputDate2"
                      placeholder=""
                      name="source_agency_id"
                      list="brow5"
                    value="{{ $bibliography->source_agency->name ?? null }}"

                    />
                    <i
                    class="i bi-hr icon icon-base my-plus-class"
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
                        <option>hhhhhhhhhhh</option>
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
                      value="{{ $bibliography->source_address ?? null }}"
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
                      value="{{ $bibliography->short_desc ?? null }}"
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
                      value="{{ $bibliography->related_year ?? null }}"
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
                      value="{{ $bibliography->source ?? null}}"
                    />
                    <label for="inputDate2" class="form-label"
                      >12) Տեղեկության աղբյուր</label
                    >
                  </div>
                </div>

                <div class="col">
                    <input type=hidden id="tags_deleted_route" value="{{route('delete-item')}}" data-model-name = "Bibliography"  data-model-id = "{{$bibliography->id}}" data-pivot-table = "country">
                    {{-- appending tags --}}
                   <div class="tegs-div">
                    {{-- {{dd($bibliography->country)}} --}}
                    @if (isset($bibliography->country))
                        @foreach ( $bibliography->country as  $item)
                            <div class="Myteg">
                                <span>{{$item->name}}</span>
                                <span class="delete-from-db"
                                      data-delete-id="{{$item->id}}"
                                      data-table="country"
                                      data-model-id={{$bibliography->id}}
                                      {{-- data-route={{route('delete-item')}} --}}
                                      >X</span>
                            </div>
                         @endforeach

                    @endif


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
                      value="{{ $bibliography->theme ?? null}}"
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
                      value="{{ $bibliography->title ?? null }}"

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
                        accept=".doc,.docx, video/mp4, video/mov"

                        />
                        <label for="file_id_word" class="file-upload-btn btn btn-secondary h-fit w-fit upload_btn">
                          Բեռնել
                        </label>
                    </div>

                        <div class="files">
                            <div class="newfile">

                            </div>
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
                        </div>
                </div>

                <div
                class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class"
                >
                <span class="form-label">17) Վիդեեյի առկայություն</span>

                <div class="form-check my-formCheck-class">
                  <input class="form-check-input form-control" type="checkbox" id="checkAll" name="hasVideo"/>
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
                <input type=hidden
                       id="updated_route"
                       value="{{route('bibliography.update',$bibliography->id)}}"
                />



              </div>

              <!-- ######################################################## -->
              <!-- Submit button -->
              <!-- ######################################################## -->
            </form>
            <!-- Vertical Form -->
          </div>
        </div>
      </section>
     
      <x-scroll-up/>
    <x-large-modal :dataId="$bibliography->id"/>
    <x-fullscreen-modal/>
@section('js-scripts')
<script>
    let lang="{{app()->getLocale()}}"
    console.log(lang);
</script>

        {{-- <script src="{{ asset('assets/js/script.js') }}"></script> --}}
        <script src="{{ asset('assets/js/script1.js') }}"></script>
        <script src="{{ asset('assets/js/tag.js') }}"></script>

@endsection
@endsection


