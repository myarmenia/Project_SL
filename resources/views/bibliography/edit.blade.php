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
          <h1>{{ __('content.bibliography') }}</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">{{ __('content.addTo') }}</a></li>
              <li class="breadcrumb-item active">{{ __('content.bibliography') }}</li>
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
                <span class="form-label">{{ __('content.date_and_time_date') }}</span>

                <span>
                    {{$carbon::parse( $bibliography->created_at)->format('Y-m-d') }}

                </span>
                </div>

                <div
                class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class"
                >
                <span class="form-label">{{ __('content.date_and_time_time') }}</span>

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
                      class="form-control fetch_input_title get_datalist save_input_data"
                      id="item1"
                      placeholder=""
                      value="{{$bibliography->agency->name ?? null }}"
                      data-modelid="{{$bibliography->agency->id ?? null }}"
                      name="from_agency_id"
                      list="brow1"
                      tabindex="1"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"

                    data-table-name='agency'
                    data-fieldname ='name'
                  ></i>
                    <label for="item1" class="form-label"
                      >1) {{ __('content.organ') }}</label
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
                      class="form-control fetch_input_title get_datalist save_input_data"
                      id="item2"
                      placeholder=""
                      name="category_id"
                      list="brow2"
                      tabindex="2"
                      value="{{ $bibliography->doc_category->name ?? null }}"
                      data-modelid="{{$bibliography->doc_category->id ?? null }}"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"

                    data-fieldname ='name'
                    data-table-name='doc_category'

                  ></i>
                    <label for="item2" class="form-label"
                      >2){{ __('content.document_category') }}</label
                    >
                  </div>
                  <datalist id="brow2" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>
                <div class="col">

                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title get_datalist save_input_data"
                      id="item3"
                      placeholder=""
                      name="access_level_id"
                      list="brow3"
                      tabindex="3"
                      value="{{ $bibliography->access_level->name ?? null}}"
                      data-modelid="{{$bibliography->access_level->id ?? null }}"
                      {{-- data-update="{{route('bibliography.update',$bibliography->id)}}" --}}
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname ='name'
                    data-table-name = 'access_level'

                  ></i>
                    <label for="item3" class="form-label"
                      >3) {{ __('content.access_level') }}</label
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
                        disabled
                      value={{$bibliography->users->username}}
                    />
                    <label for="inputDate2" class="form-label"
                      >4)  {{ __('content.created_user') }}</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control save_input_data"
                      id="inputDate2"
                      placeholder=""
                      name="reg_number"
                      tabindex="4"
                      value="{{ $bibliography->reg_number ?? null }}"

                    />
                    <label for="inputDate2" class="form-label"
                      >5)  {{ __('content.reg_document') }}</label
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
                      class="form-control save_input_data"
                      placaholder=""
                      name="reg_date"
                      tabindex="5"
                      value="{{$bibliography->reg_date ?? null}}"
                      {{-- data-update="{{ route('bibliography.update',$bibliography->id )}}" --}}
                    />
                    <label for="inputDate1" class="form-label"
                      >6)  {{ __('content.date_reg') }}</label
                    >
                    <!-- </div> -->
                  </div>
                </div>
                <!-- Inputs -->

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control save_input_data"
                      id="inputDate2"
                      placeholder=""
                      name="worker_name"
                      tabindex="6"
                      value="{{ $bibliography->worker_name ?? null}}"

                    />
                    <label for="inputDate2" class="form-label"
                      >7)  {{ __('content.worker_take_doc') }}</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title get_datalist save_input_data"
                      id="inputDate2"
                      placeholder=""
                      name="source_agency_id"
                      list="brow5"
                      tabindex="7"
                    value="{{ $bibliography->source_agency->name ?? null }}"
                    data-modelid="{{$bibliography->source_agency->id ?? null }}"


                    />
                    <i
                    class="i bi-hr icon icon-base my-plus-class"
                    data-fieldname ='name'
                    data-table-name='agency'
                  ></i>
                    <label for="inputDate2" class="form-label"
                      >8) {{ __('content.source_agency') }}</label
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
                      class="form-control save_input_data"
                      id="inputDate2"
                      placeholder=""
                      name="source_address"
                      tabindex="8"
                      value="{{ $bibliography->source_address ?? null }}"
                    />
                    <label for="inputDate2" class="form-label"
                      >9) {{ __('content.source_address') }}</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control save_input_data"
                      id="inputDate2"
                      placeholder=""
                      name="short_desc"
                      tabindex="9"
                      value="{{ $bibliography->short_desc ?? null }}"
                    />
                    <label for="inputDate2" class="form-label"
                      >10) {{ __('content.short_desc') }}</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control save_input_data"
                      id="inputDate2"
                      placeholder=""
                      name="related_year"
                      tabindex="10"
                      value="{{ $bibliography->related_year ?? null }}"
                    />
                    <label for="inputDate2" class="form-label"
                      >11) {{ __('content.related_year') }}</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control save_input_data"
                      id="inputDate2"
                      placeholder=""
                      name="source"
                      tabindex="11"
                      value="{{ $bibliography->source ?? null}}"
                    />
                    <label for="inputDate2" class="form-label"
                      >12) {{ __('content.source_inf') }}</label
                    >
                  </div>
                </div>

                <div class="col">

                    {{-- appending tags --}}

                  <x-tegs :data="$bibliography" :relation="'country'" :name="'name'" :modelName="'Bibliography'" :dataDivId="'item4'"/>
                  <div class="form-floating">

                    <input
                      type="text"
                      class="form-control fetch_input_title teg_class get_datalist save_input_data"
                      id="item4"
                      placeholder=""
                      name="country_id"
                      list="brow4"
                      data-parent-model-name = 'Bibliography'
                      data-pivot-table = 'country'
                      data-parent-model-id ="{{ $bibliography->id }}"
                      data-fieldname='name'
                      tabindex="12"

{{--                      data-table="passport"--}}
{{--                      data-model="passport"--}}
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname ='name'
                    data-table-name='country'
                  ></i>
                    <label for="item4" class="form-label"
                      >13){{ __('content.information_country') }}</label
                    >
                  </div>

                  <datalist id="brow4" class="input_datalists" style="width: 500px;" >
                  </datalist>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control save_input_data"
                      id="inputDate2"
                      placeholder=""
                      name="theme"
                      tabindex="13"
                      value="{{ $bibliography->theme ?? null}}"
                    />
                    <label for="inputDate2" class="form-label"
                      >14) {{ __('content.name_subject') }}</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control save_input_data"
                      id="inputPassportNumber1"
                      placeholder=""
                      name="title"
                      tabindex="14"
                      value="{{ $bibliography->title ?? null }}"

                    />
                    <label for="inputPassportNumber1" class="form-label"
                      >15) {{ __('content.title_document') }}</label
                    >
                  </div>
                </div>

                <div class="btn-div">
                    <div>
                    <label class="form-label">16) {{ __('content.contents_document') }}</label>
                    <input
                        id="file_id_word"
                        type="file"
                        name="file"
                        data-href-type=""
                        class="file-upload save_input_data"
                        data-render-type="none"
                        hidden
                        accept=".doc,.docx, video/mp4, video/mov"


                        />
                        <label for="file_id_word" class="file-upload-btn btn btn-secondary h-fit w-fit upload_btn">
                          {{ __('content.upload') }}
                        </label>
                    </div>

                        <div class="files">
                            <div class="newfile">

                            </div>

                            <div id='fileeHom' class="file-upload-content tegs-div" >
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
                <span class="form-label">17) {{ __('content.video') }}</span>

                <div class="form-check my-formCheck-class">
                  {{-- <input class="form-check-input form-control" type="checkbox" id="checkAll" name="hasVideo"/>--}}
                  <i class="bi bi-check2 {{$bibliography->video==1 ? 'change-video-style' : null }}"></i>
                  <input id="hiddenInp" type="hidden">
                </div>
                </div>
                  <h6>{{ __('content.short_man') }} ({{ __('content.count') }}) ։ 0</h6>
                <div class="col">
                  <div class="form-floating">
                    <select class="form-select form-control select_class" id="selectElement" name="selectInfo">
                      <option selected disabled value="" hidden></option>
                      <option  class = "bibliography_option" data-url="" value="1">{{ __('content.face') }}</option>
                      <option  class = "bibliography_option" data-url="" value="1">{{ __('content.organization') }}</option>
                      <option  class = "bibliography_option" data-url="" value="1">{{ __('content.event') }}</option>
                      <option  class = "bibliography_option" data-url="" value="1">{{ __('content.signal') }}</option>
                      <option  class = "bibliography_option" data-url="" value="1">{{ __('content.criminal') }}</option>
                      <option  class = "bibliography_option" data-url="" value="1">{{ __('content.operation') }}</option>
                      <option  class = "bibliography_option" data-url="" value="1">{{ __('content.control') }}</option>
                      <option  class = "bibliography_option" data-url="" value="1">{{ __('content.mia_summary') }}</option>
                      <option  class = "bibliography_option" data-url="{{ route('bibliography.summery_automatic',['bibliography_id'=>$bibliography->id ])}}" value="1">{{ __('content.mia_summary_avto') }}</option>
                      <option  class = "bibliography_option" data-url="{{route('table-content.index',['bibliography_id'=>$bibliography->id ])}}" value="1"><a href="{{route('table-content.index')}}">{{ __('content.table_avto') }}</a></option>
                      <option  class = "bibliography_option" data-url="{{route('reference')}}" value="1"><a href="{{route('reference')}}">{{ __('content.reference') }}</a></option>
                    </select>
                    <label class="form-label"
                      >18) {{ __('content.inf_cont') }}</label
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

                                {{$item->middleName!=null  ? $item->middleName->middle_name :null }}

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
                            <td scope="row" class="td-icon text-center">
                                <a target="blank" href="{{route('get-file',['path'=>$item->file->path])}}">
                                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                    <span>file name</span>
                                </a>
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
            let result_search_dont_matched = `{{ __('validation.result_search_dont_matched') }}`
            // console.log(delete_item);
            let parent_id = "{{$bibliography->id}}"
        </script>

            <script src="{{ asset('assets/js/script.js') }}"></script>
            {{-- <script src="{{ asset('assets/js/script1.js') }}"></script> --}}
            <script src="{{ asset('assets/js/tag.js') }}"></script>

            <script src="{{ asset('assets/js/error_modal.js') }}"></script>
            <script src="{{ asset('assets/js/select_options.js') }}"></script>
            <script src="{{ asset('assets/js/file_upload_delete.js') }}"></script>



    @endsection
@endsection
