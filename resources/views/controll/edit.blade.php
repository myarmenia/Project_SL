@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/control/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection
@inject('carbon', 'Carbon\Carbon')

@section('content')


    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">


                <!-- Vertical Form -->
                <x-back-previous-url />
                <form class="form">
                    <div class="inputs row g-3">

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="item1" name="unit_id" value="{{ $controll->unit->name ?? null }}"
                                    data-type="update_field" data-modelid="{{ $controll->unit_id ?? null }}"
                                    list="brow1" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name="agency" data-fieldname='name'></i>
                                <label for="item1" class="form-label">1) Ստորաբաժանում</label>
                            </div>
                            <datalist id="brow1" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="item2" name="doc_category_id"
                                    value="{{ $controll->doc_category->name ?? null }}" data-type="update_field"
                                    data-modelid="{{ $controll->doc_category_id ?? null }}" list="brow2" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name="doc_category"
                                    data-fieldname='name'></i>
                                <label for="item2" class="form-label">2) Փաստաթղթի կատեգորիա</label>
                            </div>
                            <datalist id="brow2" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="item3" name="creation_date" value="{{ $controll->creation_date ?? null }}"
                                    data-type="update_field" />
                                <label for="item3" class="form-label">3) Փաստաթղթի կազմման ամսաթիվ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" id="item4" name="reg_num"
                                    value="{{ $controll->reg_num ?? null }}" data-type="update_field" />
                                <label for="item4" class="form-label">4) Փաստաթղթի գրանցման ամսաթիվը</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" class="form-control  save_input_data" id="item5" name="reg_date"
                                    value="{{ $controll->reg_date ?? null }}" data-type="update_field" />
                                <label for="item5" class="form-label">5) Գրանցման ամսաթիվ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control  save_input_data" id="item6"
                                    value="{{ $controll->snb_director ?? null }}" data-type="update_field"
                                    name="snb_director" />
                                <label for="item6" class="form-label">6) ԱԱԾ տնօրեն (ԱՀԱ)</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" id="item7"
                                    value="{{ $controll->snb_subdirector ?? null }}" data-type="update_field"
                                    name="snb_subdirector" />
                                <label for="item7" class="form-label">7) ԱԱԾ Փոխտնօրեն (ԱՀԱ)</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">

                                <input type="date" class="form-control  save_input_data" id="item8"
                                    name="resolution_date" value="{{ $controll->resolution_date ?? null }}"
                                    data-type="update_field" />
                                <label for="item8" class="form-label">8) Մակագրության ամսաթիվ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <textarea id="area" class="video_teg_text_area" name="resolution" cols="30" rows="10" class="form-control  save_input_data"
                                    data-type="update_field">{{ $controll->resolution ?? null }}</textarea>
                                <label for="area" class="form-label">9) Մակագրություն</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="item10" value="{{ $controll->act_unit->name ?? null }}"
                                    data-type="update_field" {{-- data-modelid="{{ $controll->act_unit_id ?? null }}" --}} name="act_unit_id " list="brow3" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name="agency" data-fieldname='name'></i>
                                <label for="item10" class="form-label">10) Կատարող Ստորաբաժանում</label>
                            </div>
                            <datalist id="brow3" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" id="item11"
                                    data-type="update_field" name="actor_name"
                                    value="{{ $controll->actor_name ?? null }}" />
                                <label for="item7" class="form-label">11) Կատարողի ազգանունը</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="item12" value="{{ $controll->sub_act_unit->name ?? null }}"
                                    data-type="update_field" name="sub_act_unit_id " list="brow4" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name="agency" data-fieldname='name'></i>
                                <label for="item12" class="form-label">12) Համատեղ կատարող ստորաբաժանում</label>
                            </div>
                            <datalist id="brow4" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" id="item13"
                                    name="sub_actor_name" data-type="update_field"
                                    value="{{ $controll->sub_actor_name ?? null }}" />
                                <label for="item13" class="form-label">13) Կատարողի ազգանունը</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="item14" name="result_id"
                                    value="{{ $controll->controll_result->name ?? null }}" data-type="update_field"
                                    list="brow5" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name="control_result"
                                    data-fieldname='name'></i>
                                <label for="item14" class="form-label">14) Կատարման արդյունքը</label>
                            </div>
                            <datalist id="brow5" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">15) Փաստաթղթի բովանդակութըունը</label>
                            <div class="file-upload-content tegs-div">
                                <x-tegs name="name" :data="$controll->bibliography" relation="files" />
                            </div>
                        </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control save_input_data"
                      id="item13"
                      name="sub_actor_name"
                      data-type="update_field"
                      value="{{ $controll->sub_actor_name ?? null }}"
                    />
                    <label for="item13" class="form-label"
                      >13) Կատարողի ազգանունը</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title save_input_data get_datalist"
                      id="item14"
                      name="result_id"
                      value="{{ $controll->controll_result->name ?? null }}"
                      data-type="update_field"
                      list="brow5"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-table-name="control_result"
                    data-fieldname='name'
                  ></i>
                    <label for="item14" class="form-label"
                      >14) Կատարման արդյունքը</label
                    >
                  </div>
                  <datalist id="brow5" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="btn-div">
                    <label class="form-label">15) Փաստաթղթի բովանդակութըունը</label>
                    <div class="file-upload-content tegs-div">
                        <x-tegs name="name" :data="$controll->bibliography" relation="files"  />
                    </div>
                </div>

                <div class="btn-div">
                    <label class="form-label">16) Կապեր</label>
                    <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police">
                        <x-teg :name="'id'" :item="$controll->bibliography" inputName="bibliography"  inputValue="$controll->bibliography_id" :label="__('content.short_bibl')"/>

                    </div>
                </form>

               

                <!-- Vertical Form -->
            </div>
        </div>
    </section>

    <input type="hidden" id="file_updated_route" value="">
    <input type="hidden" id="deleted_route" value="" data-pivot-table = "file">

    <x-scroll-up />
    <x-fullscreen-modal />
    <x-errorModal />

@section('js-scripts')
    <script>
        let updated_route = `{{ route('controll.update', $controll->id) }}`
        let parent_id = "{{ $controll->id }}"
        let delete_item = "{{ route('delete_tag') }}"

        let ties = "{{ __('content.ties') }}"
        let parent_table_name = "{{ __('content.control') }}"
    </script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/tag.js') }}"></script>

    <script src="{{ asset('assets/js/error_modal.js') }}"></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
@endsection
@endsection
