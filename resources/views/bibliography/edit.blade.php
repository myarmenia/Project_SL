@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/bibliography/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bibliography/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection
@inject('carbon', 'Carbon\Carbon')

@section('content')


    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <!-- Vertical Form -->
                <x-back-previous-url />
                {{-- <form class="form"> --}}
                <div class="inputs row g-3">

                    <div class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class">
                        <span class="form-label">{{ __('content.date_and_time_date') }}</span>


                        <span>
                            {{ $carbon::parse($bibliography->created_at)->format('Y-m-d') }}

                        </span>
                    </div>

                    <div class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class">
                        <span class="form-label">{{ __('content.date_and_time_time') }}</span>

                        <span>
                            {{-- 11։05։56 --}}
                            {{ $carbon::parse($bibliography->created_at)->format('H:i:s') }}
                        </span>
                    </div>
                    <!-- To open modal """fullscreenModal""" -->

                    <input type="hidden" class="form-control " name="bibliography_id" value="{{ $bibliography->id }}">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control fetch_input_title get_datalist save_input_data"
                                id="item1" value="{{ $bibliography->agency->name ?? null }}"
                                data-modelid="{{ $bibliography->agency->id ?? null }}" name="from_agency_id" list="brow1"
                                tabindex="1" />
                            <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                data-bs-target="#fullscreenModal" data-table-name='agency' data-fieldname ='name'>
                            </i>
                            <label for="item1" class="form-label">1) {{ __('content.organ') }}</label>
                        </div>

                        <datalist id="brow1" class="input_datalists" style="width: 500px;">
                            <option>aaaaa</option>
                        </datalist>
                    </div>

                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control fetch_input_title get_datalist save_input_data"
                                id="item2" placeholder="" name="category_id" list="brow2" tabindex="2"
                                value="{{ $bibliography->doc_category->name ?? null }}"
                                data-modelid="{{ $bibliography->doc_category->id ?? null }}" />
                            <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                data-bs-target="#fullscreenModal" data-fieldname ='name' data-table-name='doc_category'></i>
                            <label for="item2" class="form-label">2){{ __('content.document_category') }}</label>
                        </div>
                        <datalist id="brow2" class="input_datalists" style="width: 500px;">

                        </datalist>
                    </div>
                    <div class="col">

                        <div class="form-floating">
                            <input type="text" class="form-control fetch_input_title get_datalist save_input_data"
                                id="item3" placeholder="" name="access_level_id" list="brow3" tabindex="3"
                                value="{{ $bibliography->access_level->name ?? null }}"
                                data-modelid="{{ $bibliography->access_level->id ?? null }}" {{-- data-update="{{route('bibliography.update',$bibliography->id)}}" --}} />
                            <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                data-bs-target="#fullscreenModal" data-fieldname ='name'
                                data-table-name = 'access_level'></i>
                            <label for="item3" class="form-label">3) {{ __('content.access_level') }}</label>
                        </div>
                        <datalist id="brow3" class="input_datalists" style="width: 500px;">

                        </datalist>
                    </div>

                    <!-- Date Input -->
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control fetch_input_title" id="inputDate2" placeholder=""
                                name="user_id" disabled value={{ $bibliography->users->username }} />
                            <label for="inputDate2" class="form-label">4) {{ __('content.created_user') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control save_input_data" id="inputDate2" placeholder=""
                                name="reg_number" tabindex="4" value="{{ $bibliography->reg_number ?? null }}" />
                            <label for="inputDate2" class="form-label">5) {{ __('content.reg_document') }}</label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-floating input-date-wrapper">
                            <!-- <div class="input-date-wrapper"> -->
                            <!-- <label for="inputDate1" role="value"></label>
                                    <input type="text" hidden role="store" /> -->
                            <input type="date" placeholder="" id="inputDate1" class="form-control save_input_data"
                                placaholder="" name="reg_date" tabindex="5"
                                value="{{ $bibliography->reg_date ?? null }}" {{-- data-update="{{ route('bibliography.update',$bibliography->id )}}" --}} />
                            <label for="inputDate1" class="form-label">6) {{ __('content.date_reg') }}</label>
                            <!-- </div> -->
                        </div>
                    </div>
                    <!-- Inputs -->

                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control save_input_data" id="inputDate2" placeholder=""
                                name="worker_name" tabindex="6" value="{{ $bibliography->worker_name ?? null }}" />
                            <label for="inputDate2" class="form-label">7) {{ __('content.worker_take_doc') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control fetch_input_title get_datalist save_input_data"
                                id="inputDate2" placeholder="" name="source_agency_id" list="brow5" tabindex="7"
                                value="{{ $bibliography->source_agency->name ?? null }}"
                                data-modelid="{{ $bibliography->source_agency->id ?? null }}" />
                            <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                data-bs-target="#fullscreenModal" data-table-name='agency' data-fieldname ='name'>
                            </i>
                            <label for="inputDate2" class="form-label">8) {{ __('content.source_agency') }}</label>

                        </div>
                        <datalist id="brow5" class="input_datalists" style="width: 500px;">
                            <option>hhhhhhhhhhh</option>
                        </datalist>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control save_input_data" id="inputDate2" placeholder=""
                                name="source_address" tabindex="8"
                                value="{{ $bibliography->source_address ?? null }}" />
                            <label for="inputDate2" class="form-label">9) {{ __('content.source_address') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control save_input_data" id="inputDate2" placeholder=""
                                name="short_desc" tabindex="9" value="{{ $bibliography->short_desc ?? null }}" />
                            <label for="inputDate2" class="form-label">10) {{ __('content.short_desc') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control save_input_data" id="inputDate2" placeholder=""
                                name="related_year" tabindex="10" value="{{ $bibliography->related_year ?? null }}" />
                            <label for="inputDate2" class="form-label">11) {{ __('content.related_year') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control save_input_data" id="inputDate2" placeholder=""
                                name="source" tabindex="11" value="{{ $bibliography->source ?? null }}" />
                            <label for="inputDate2" class="form-label">12) {{ __('content.source_inf') }}</label>
                        </div>
                    </div>

                    <div class="col">

                        {{-- appending tags --}}

                        <x-tegs :data="$bibliography" :relation="'country'" name="name" delete />
                        <div class="form-floating">
                            <input type="text"
                                class="form-control fetch_input_title teg_class get_datalist save_input_data"
                                id="item4" placeholder="" name="country_id" list="brow4"
                                data-parent-model-name = 'Bibliography' data-pivot-table = 'country'
                                data-parent-model-id ="{{ $bibliography->id }}" data-fieldname='name' tabindex="12"
                                {{--                      data-table="passport" --}} {{--                      data-model="passport" --}} />
                            <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                data-bs-target="#fullscreenModal" data-fieldname ='name' data-table-name='country'></i>
                            <label for="item4" class="form-label">13){{ __('content.information_country') }}</label>
                        </div>

                        <datalist id="brow4" class="input_datalists" style="width: 500px;">
                        </datalist>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control save_input_data" id="inputDate2" placeholder=""
                                name="theme" tabindex="13" value="{{ $bibliography->theme ?? null }}" />
                            <label for="inputDate2" class="form-label">14) {{ __('content.name_subject') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control save_input_data" id="inputPassportNumber1"
                                placeholder="" name="title" tabindex="14"
                                value="{{ $bibliography->title ?? null }}" />
                            <label for="inputPassportNumber1" class="form-label">15)
                                {{ __('content.title_document') }}</label>
                        </div>
                    </div>

                    <div class="btn-div btn-div-video">
                        <div>
                            <label class="form-label">16) {{ __('content.contents_document') }}</label>
                            <input id="file_id_word" type="file" name="file" data-href-type=""
                                class="file-upload save_input_data" data-render-type="none" hidden
                                accept=".doc,.docx, video/mp4, video/mov" />
                            <label for="file_id_word" class="file-upload-btn btn btn-secondary h-fit w-fit upload_btn">
                                {{ __('content.upload') }}
                            </label>
                        </div>

                        <div class="files">
                            <div class="newfile">
                            </div>
                                <div id='fileeHom' class="file-upload-content tegs-div">


                                    @foreach ($bibliography->files as $file)
                                            @if ($file->via_summary==0)
                                                <div class="Myteg video-teg-class">
                                                    <span><a href = "" class="teg-text">{{$file->real_name}}</a></span>
                                                    <textarea
                                                        class="video_teg_text_area save_input_data"
                                                        data-type="update_field"
                                                        name="file_comment" id="" cols="30" rows="10"

                                                    >{{$file->file_comment ?? null}}</textarea>
                                                    <span class="delete-items-from-db xMark"
                                                        data-delete-id = "{{ $file->id }}"
                                                        data-table = 'file'
                                                        data-model-id = "{{ $bibliography->id }}"
                                                        data-model-name="Bibliography"

                                                        >X</span>
                                                </div>
                                            @endif
                                    @endforeach



                            </div>
                        </div>

{{-- {{dd($bibliography->video)}} --}}

                        <div class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class">
                            <span class="form-label">17) {{ __('content.video') }}</span>

                            <div class="form-check my-formCheck-class">

                                <i class="bi bi-check2 {{ $bibliography->video == 1 ? 'change-video-style' : 'change-video-display-none' }}"></i>
                                <input id="hiddenInp" type="hidden">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select form-control select_class" id="selectElement"
                                    name="selectInfo">
                                    <option selected disabled value="" hidden></option>
                                    {{--                                    'main_route' => request()->main_route, 'relation' => request()->relation, 'relation_id' => request()->model_id, --}}
                                    <option class = "bibliography_option"
                                        data-url="{{ route('open.page', ['page' => 'man', 'model' => 'bibliography', 'id' => $bibliography->id, 'main_route' => 'bibliography.edit', 'relation' => 'bibliography']) }}"
                                        value="1">
                                        {{ __('content.face') }}</option>
                                    <option class = "bibliography_option"
                                        data-url="{{ route('open.page', ['page' => 'organization', 'model' => 'bibliography', 'id' => $bibliography->id, 'main_route' => 'bibliography.edit', 'relation' => 'bibliography']) }}"
                                        value="1">
                                        {{ __('content.organization') }}</option>
                                    <option class = "bibliography_option"
                                        data-url="{{ route('event.create', ['lang' => app()->getLocale(), 'bibliography_id' => $bibliography->id]) }}"
                                        value="1">
                                        {{ __('content.event') }}</option>
                                    <option class = "bibliography_option"
                                        data-url="{{ route('signal.create', ['lang' => app()->getLocale(), 'bibliography_id' => $bibliography->id]) }}"
                                        value="1">
                                        {{ __('content.signal') }}</option>
                                    <option class = "bibliography_option"
                                        data-url="{{ route('criminal_case.create', ['lang' => app()->getLocale(), 'bibliography_id' => $bibliography->id]) }}"
                                        value="1">
                                        {{ __('content.criminal') }}</option>
                                    <option class = "bibliography_option"
                                        data-url="{{ route('action.create', $bibliography->id) }}" value="1">
                                        {{ __('content.operation') }}</option>
                                    <option class = "bibliography_option"
                                        data-url="{{ route('controll.create', ['lang' => app()->getLocale(), 'bibliography_id' => $bibliography->id]) }}"
                                        value="1">
                                        {{ __('content.control') }}</option>
                                    <option class = "bibliography_option"
                                        data-url="{{ route('mia_summary.create', ['lang' => app()->getLocale(), 'bibliography_id' => $bibliography->id]) }}"
                                        value="1">
                                        {{ __('content.mia_summary') }}</option>
                                    <option class = "bibliography_option"
                                        data-url="{{ route('bibliography.summery_automatic', ['bibliography_id' => $bibliography->id]) }}"
                                        value="1">{{ __('content.mia_summary_avto') }}</option>
                                    <option class = "bibliography_option"
                                        data-url="{{ route('table-content.index', ['bibliography_id' => $bibliography->id]) }}"
                                        value="1"><a
                                            href="{{ route('table-content.index') }}">{{ __('content.table_avto') }}</a>
                                    </option>
                                    <option class = "bibliography_option"
                                        data-url="{{ route('reference', ['bibliography_id' => $bibliography->id]) }}"
                                        value="1"><a
                                            href="{{ route('reference') }}">{{ __('content.reference') }}</a></option>
                                </select>
                                <label class="form-label">18) {{ __('content.inf_cont') }}</label>
                            </div>
                        </div>
                        <div class="man-count-div">

                            <h6 class="man-count">{{ __('content.short_man') }} ({{ __('content.count') }}) ։
                                {{ count($bibliography->man) }}</h6>
                            {{-- ------------------ file when we upload summary  --------------------- --}}
                            <div id='fileeHom' class="file-upload-content tegs-div">
                                <x-tegs :data="$bibliography" relation="files" name="real_name" scope="miaSummary" scopeParam="1"/>
                            </div>
                        </div>
                    </div>
                    {{-- </form> --}}
                    <!-- Bordered Table -->


                    @foreach ($bibliography->modelRelations as $key => $relation)
                        {{-- if send text ex. disabledSecondRelation="man" --}}
                        <x-bibliography-table-relation :parentModel="$bibliography" :relation="$relation" innerRelation="man"
                            disabledSecondRelation="man" />
                    @endforeach


            <div class="modalRightDoc" id="modalRightDoc">
                <div style="display: flex;justify-content: end">
                  <span class="close_btn" id="close_btn">&#10005;</span>
                </div>
                <div id="paragraph_info" class="p-2"></div>
                <!-- End Bordered Table -->

                        <!-- Vertical Form -->
                    </div>
                </div>
    </section>


    <input type="hidden" id="deleted_route" value="{{ route('delete-items') }}" data-pivot-table = "file">



    <x-scroll-up />
    <x-fullscreen-modal />
    <x-errorModal />

@section('js-scripts')
    <script>
        let updated_route = `{{ route('bibliography.update', $bibliography->id) }}`
        // console.log(updated_route);
        let file_updated_route = `{{ route('updateFile', $bibliography->id) }}`
        let delete_item = "{{ route('delete-item') }}"
        // console.log(delete_item);
        let parent_id = "{{ $bibliography->id }}"
        let parent_table_name = "{{ __('content.man') }}"
        // filter translate //
        let equal = "{{ __('content.equal') }}" // havasar e
        let not_equal = "{{ __('content.not_equal') }}" // havasar che
        let more = "{{ __('content.more') }}" // mec e
        let more_equal = "{{ __('content.more_equal') }}" // mece kam havasar
        let less = "{{ __('content.less') }}" // poqre
        let less_equal = "{{ __('content.less_equal') }}" // poqre kam havasar
        let contains = "{{ __('content.contains') }}" // parunakum e
        let start = "{{ __('content.start') }}" // sksvum e
        let search_as = "{{ __('content.search_as') }} " // pntrel nayev
        let seek = "{{ __('content.seek') }}" // pntrel
        let clean = "{{ __('content.clean') }}" // maqrel
        let and_search = "{{ __('content.and') }}" // ev
        let or_search = "{{ __('content.or') }}" // kam
        // filter translate //
    </script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/tag.js') }}"></script>

    <script src="{{ asset('assets/js/error_modal.js') }}"></script>
    <script src="{{ asset('assets/js/select_options.js') }}"></script>
    <script src="{{ asset('assets/js/file_upload_delete.js') }}"></script>
    {{-- showing man info --}}
    <script src="{{ asset('assets/js/bibliography/edit.js') }}"></script>
    <script src="{{ asset('assets/js/bibliography-table-relation/index.js') }}"></script>
    {{-- <script src='{{ asset('assets/js/main/table.js') }}'></script> --}}
@endsection
@endsection
