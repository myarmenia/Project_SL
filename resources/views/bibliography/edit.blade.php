@extends('layouts.auth-app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/bibliography/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
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

                    <input
                      type="text"
                      class="form-control fetch_input_title get_datalist"
                      id="item1"
                      placeholder=""
                      value="{{$bibliography->agency->name ?? null }}"
                      name="from_agency_id"
                      list="brow1"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"

                    data-table-name='agency'
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
                      class="form-control fetch_input_title get_datalist"
                      id="item2"
                      placeholder=""
                      name="category_id"
                      list="brow2"
                      value="{{ $bibliography->doc_category->name ?? null }}"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"

                    data-fieldname ='name'
                    data-table-name='doc_category'

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
                      class="form-control fetch_input_title get_datalist"
                      id="item3"
                      placeholder=""
                      name="access_level_id"
                      list="brow3"
                      value="{{ $bibliography->access_level->name ?? null}}"
                      data-update="{{route('bibliography.update',$bibliography->id)}}"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname ='name'
                    data-table-name = 'access_level'

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
                      class="form-control"
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
                      class="form-control fetch_input_title get_datalist"
                      id="inputDate2"
                      placeholder=""
                      name="source_agency_id"
                      list="brow5"
                    value="{{ $bibliography->source_agency->name ?? null }}"

                    />
                    <i
                    class="i bi-hr icon icon-base my-plus-class"
                    data-fieldname ='name'
                    data-table-name='agency'
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
                      >9) Նախնական նյութերի պահպանման տեղ</label
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

                    {{-- appending tags --}}

                  <x-tegs :data="$bibliography" :relation="'country'" :name="'name'" :modelName="'Bibliography'"/>
                  <div class="form-floating">

                    <input
                      type="text"
                      class="form-control fetch_input_title teg_class get_datalist"
                      id="item4"
                      placeholder=""
                      name="country_id"
                      list="brow4"
                      data-parent-model-name = 'Bibliography'
                      data-pivot-table = 'country'
                      data-parent-model-id ="{{ $bibliography->id }}"

                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname ='name'
                    data-table-name='country'
                  ></i>
                    <label for="item4" class="form-label"
                      >13) Երկիր, որին վերաբերում է տեղեկությունը</label
                    >
                  </div>

                  <datalist id="brow4" class="input_datalists" style="width: 500px;" >
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

                            <div id='fileeHom' class="file-upload-content tegs-div">
                            @foreach ($bibliography->files as $file )
                                    <div class="Myteg">
                                        <span><a href = "">{{$file->name}}</a></span>
                                        <span class="delete-items-from-db"
                                              data-delete-id = "{{ $file->id }}"
                                              data-table = 'file'
                                              data-model-id = "{{ $bibliography->id }}"
                                              data-model-name="Bibliography"

                                            >X</span>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                </div>

                <div
                class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class"
                >
                <span class="form-label">17) Վիդեոյի առկայություն</span>

                <div class="form-check my-formCheck-class">
                  {{-- <input class="form-check-input form-control" type="checkbox" id="checkAll" name="hasVideo"/>
                  --}}
                  <i class="bi bi-check2 "></i>
                  <input id="hiddenInp" type="hidden">
                </div>
                </div>
                  <h6>ԱՆՁ (ՔԱՆԱԿԸ) ։ 0</h6>
                <div class="col">
                  <div class="form-floating">
                    <select class="form-select form-control select_class" id="selectElement" name="selectInfo">
                      <option selected disabled value="" hidden></option>
                      <option  class = "bibliography_option" data-url="" value="1">Անձ</option>
                      <option  class = "bibliography_option" data-url="" value="1">Կազմակերպություն</option>
                      <option  class = "bibliography_option" data-url="" value="1">Իրադարձություն</option>
                      <option  class = "bibliography_option" data-url="" value="1">Ահազանգ</option> class = "bibliography_option" data-url=""
                      <option  class = "bibliography_option" data-url="" value="1">Քրեական գործ</option>
                      <option  class = "bibliography_option" data-url="" value="1">Գործողություն</option>
                      <option  class = "bibliography_option" data-url="" value="1">Վերահսկում</option>
                      <option  class = "bibliography_option" data-url="" value="1">Ոստիկանության վիճակագրություն</option>
                      <option  class = "bibliography_option" data-url="{{ route('bibliography.summery_automatic',['bibliography_id'=>$bibliography->id ])}}" value="1">Վիճակագրության ավելացում ինքնաաշխատ եղանակով</option>
                      <option  class = "bibliography_option" data-url="{{route('table-content.index',['bibliography_id'=>$bibliography->id ])}}" value="1"><a href="{{route('table-content.index')}}">Վիճակագրության  անձերի աղյուսակների ավելացում ինքնաաշխատ եղանակով</a></option>
                    </select>
                    <label class="form-label"
                      >18) Պարունակում է տեղեկատվություն</label
                    >
                  </div>
                </div>
              </div>
            </form>
               <!-- Bordered Table -->
               <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    {{-- <th scope="col">{{__('table.status')}}</th>
                    <th scope="col">{{__('table.remove')}}</th> --}}
                    <th scope="col">{{__('table.name')}}</th>
                    <th scope="col">{{__('table.last_name')}}</th>
                    <th scope="col">{{__('table.patronymic')}}</th>
                    <th scope="col">{{__('table.birthday')}}</th>
                    {{-- <th scope="col" class="td-xs">{{__('table.file')}}</th> --}}
                    <th scope="col">{{__('button.edit')}}</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($bibliography->man as $key=>$item )

                        <tr class="start">
                            <td scope="row">{{$item->id}}</td>

                            {{-- <td scope="row" class="td-icon">
                            <i class="bi icon icon-y icon-base bi-check"></i>
                            </td>
                            <td scope="row" class="td-icon">
                            <i class="bi icon icon-sm bi-trash"></i>
                            </td> --}}


                            <td contenteditable="true" spellcheck="false">

                                {{ $item->firstName->first_name }}

                            </td>
                            <td contenteditable="true" spellcheck="false">
                                {{$item->lastName->last_name}}
                            </td>
                            <td contenteditable="true" spellcheck="false">

                                {{$item->middleName->middle_name!=null  ? $item->middleName->middle_name :null }}

                            </td>
                            <td contenteditable="true" spellcheck="false">
                                 {{$item->birthday_str!=null ? $item->birthday_str: null }}
                            </td>

                            {{-- <td>
                                <div class="file-box-title">
                                    <a target="blank" href="{{route('get-file',['path'=>$item->file->path])}}">
                                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                    <span>file name</span>
                                    </a>
                                </div>
                            </td> --}}
                            <td scope="row" class="td-icon text-center">
                               <a href="{{ route('man.edit',$item->id)}}"> <i class="bi bi-pen"></i></a>
                            </td>
                      </tr>

                    @endforeach

                </tbody>
              </table>
              <!-- End Bordered Table -->

            <!-- Vertical Form -->
          </div>
        </div>
        </section>

    <input type="hidden"  id="file_updated_route" value="{{ route('updateFile',$bibliography->id)}}">
    <input type="hidden"  id="deleted_route" value="{{ route('delete-items',)}}"  data-pivot-table = "file">

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>

    @section('js-scripts')
        <script>
            let lang="{{app()->getLocale()}}"

            let open_modal_url=`{{route('open.modal')}}`
            let get_filter_in_modal = `{{route('get-model-filter')}}`
            // console.log(get_filter_in_modal);
            let updated_route =`{{route('bibliography.update',$bibliography->id)}}`
            // console.log(updated_route);
            let file_updated_route =`{{ route('updateFile',$bibliography->id)}}`
            let delete_item = "{{route('delete-item')}}"
            // console.log(delete_item);

        </script>

            <script src="{{ asset('assets/js/script.js') }}"></script>
            {{-- <script src="{{ asset('assets/js/script1.js') }}"></script> --}}
            <script src="{{ asset('assets/js/tag.js') }}"></script>

            <script src="{{ asset('assets/js/error_modal.js') }}"></script>
            <script src="{{ asset('assets/js/select_options.js') }}"></script>
            <script src="{{ asset('assets/js/file_upload_delete.js') }}"></script>



    @endsection
@endsection

