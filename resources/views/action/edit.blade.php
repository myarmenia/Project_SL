@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/action/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/calendar.css') }}">

@endsection

@section('content')

    <!-- End Page Title -->
    <section class="section">
        <div class="card">
            <div class="card-body">

                <!-- Vertical Form -->
                <x-back-previous-url />
                <div class="form">
                    <div class="inputs row g-3">


                        <div class="btn-div more_data" id="attach_file" data-type="create_relation"
                            data-model="material_content" data-fieldname="content">
                            <label class="form-label">1) {{ __('content.content_materials_actions') }}</label>
                            <button class="btn btn-primary" style="font-size: 13px" data-bs-toggle="modal"
                                data-bs-target="#additional_information">{{ __('content.addTo') }}
                            </button>
                            <x-tegs :data="$action" relation="material_content" name="id" delete />

                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="  form-control fetch_input_title save_input_data get_datalist"
                                    id="action_qualification_id" placeholder="" name="action_qualification_id"
                                    value="{{ $action->qualification_column?->name }}" tabindex="1"
                                    data-type="update_field" data-fieldname="name" list="action_qualification_list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/4"
                                    data-table-name='action_qualification' data-fieldname='name'></i>
                                <label for="action_qualification_id" class="form-label">2)
                                    {{ __('content.qualification_fact') }}</label>
                            </div>
                            <datalist id="action_qualification_list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper calendar-container">
                                <input
                                    autocomplete="off" onblur="handleBlur(this)"
                                    type="text"
                                    placeholder=""
                                    value="{{ $action->start_date}}"
                                    id="start_date" tabindex="2" data-type="date" data-check="date" class="form-control save_input_data calendarInput"
                                    name="start_date"
                                     />
                                     <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>
                                    <label for="start_date" class="form-label"> 3)
                                    {{ __('content.start_action_date') }}</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input id="start_date_time" type="time" placeholder=""
                                    value="{{ $action->start_date && date('H:i', strtotime($action->start_date)) != '00:00' ? date('H:i', strtotime($action->start_date)) : null }}"
                                    tabindex="3" data-type="update_time" class="form-control save_input_data"
                                    name="start_time" />
                                <label for="start_date_time" class="form-label">4)
                                    {{ __('content.start_action_time') }}</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper calendar-container">
                                <input  type="text" placeholder=""
                                        autocomplete="off" onblur="handleBlur(this)"
                                        value="{{ $action->end_date}}"
                                        id="end_date" tabindex="4" data-type="date" data-check="date" class="form-control save_input_data calendarInput"
                                        name="end_date" />
                                        <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>

                                <label for="end_date" class="form-label"> 5) {{ __('content.end_action_date') }}</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input id="start_date_time" type="time" placeholder=""
                                    value="{{ $action->end_date && date('H:i', strtotime($action->end_date)) != '00:00' ? date('H:i', strtotime($action->end_date)) : null }}"
                                    tabindex="5" data-type="update_time" class="form-control save_input_data"
                                    name="end_time" />
                                <label for="start_date_time" class="form-label">6)
                                    {{ __('content.end_action_time') }}</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="  form-control fetch_input_title save_input_data get_datalist"
                                    id="action_duration_id" placeholder="" name="duration_id"
                                    value="{{ $action->duration?->name }}" tabindex="6" data-type="update_field"
                                    data-fieldname="name" list="action_duration_list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/4" data-table-name='duration'
                                    data-fieldname='name'></i>
                                <label for="action_duration_id" class="form-label">7)
                                    {{ __('content.duration_action') }}</label>
                            </div>
                            <datalist id="action_duration_list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="  form-control fetch_input_title save_input_data get_datalist"
                                    id="acton_goal_id" placeholder="" name="goal_id" value="{{ $action->goal?->name }}"
                                    tabindex="7" data-type="update_field" data-fieldname="name"
                                    list="action_goal_list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/4" data-table-name='action_goal'
                                    data-fieldname='name'></i>
                                <label for="acton_goal_id" class="form-label">8)
                                    {{ __('content.purpose_motive_reason') }}</label>
                            </div>
                            <datalist id="action_goal_list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="  form-control fetch_input_title save_input_data get_datalist"
                                    id="acton_term_id" placeholder="" name="terms_id"
                                    value="{{ $action->terms?->name }}" tabindex="8" data-type="update_field"
                                    data-fieldname="name" list="action_term_list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/4" data-table-name='terms'
                                    data-fieldname='name'></i>
                                <label for="acton_term_id" class="form-label">9)
                                    {{ __('content.terms_actions') }}</label>
                            </div>
                            <datalist id="action_term_list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="  form-control fetch_input_title save_input_data get_datalist"
                                    id="acton_aftermath_id" placeholder="" name="aftermath_id"
                                    value="{{ $action->aftermath?->name }}" tabindex="9" data-type="update_field"
                                    data-fieldname="name" list="action_aftermath_list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/4" data-table-name='aftermath'
                                    data-fieldname='name'></i>
                                <label for="acton_aftermath_id" class="form-label">10)
                                    {{ __('content.ensuing_effects') }}</label>
                            </div>
                            <datalist id="action_aftermath_list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">11) {{ __('content.action_related_event_action') }}</label>
                            <a  href="{{ route('open.page', ['page' => 'action', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'action']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$action" relation="action" name="id" :label="__('content.short_action')" tableName="action" related delete :edit="['page' =>'action.edit', 'main_route' => 'action.edit', 'id' => $action->id,'model' => 'action']"/>
                        </div>

                        <div class="btn-div">

                            <label class="form-label">12) {{ __('content.action_related_event') }}</label>
                            <a href="{{ route('open.page', ['page' => 'event', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'event']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_event')" :data="$action" relation="event" name="id" tableName="event" related delete :edit="['page' =>'event.edit', 'main_route' => 'action.edit', 'id' => $action->id,'model' => 'action']"/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">13) {{ __('content.object_action_man') }}</label>
                            <a href="{{ route('open.page', ['page' => 'man', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'man']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_man')" :data="$action" relation="man" name="id" tableName="man" related delete :edit="['page' =>'man.edit', 'main_route' => 'action.edit', 'id' => $action->id,'model' => 'action']"/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">14) {{ __('content.object_action_event') }}</label>
                            <a href="{{ route('open.page', ['page' => 'man', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'man']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_event')" :data="$action" relation="event" name="id" tableName="man" related delete :edit="['page' =>'event.edit', 'main_route' => 'action.edit', 'id' => $action->id,'model' => 'action']"/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">15) {{ __('content.object_action_organization') }}</label>
                            <a href="{{ route('open.page', ['page' => 'organization', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'organization']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_organ')" :data="$action" relation="organization" name="id" tableName="organization" related delete :edit="['page' =>'organization.edit', 'main_route' => 'action.edit', 'id' => $action->id,'model' => 'action']"/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">16) {{ __('content.object_action_phone') }}</label>
                            <a href="{{ route('phone.create', ['model' => 'action', 'id' => $action->id]) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$action" relation="phone" name="number" :label="__('content.short_phone')" tableName="phone"
                                related delete :edit="['page' =>'phone.edit', 'main_route' => 'action.edit', 'id' => $action->id, 'model' => 'action']" />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">17) {{ __('content.object_action_weapon') }}</label>
                            <a href="{{ route('open.page', ['page' => 'weapon', 'main_route' => 'action.edit','model' => 'action', 'model_id' => $action->id, 'relation' => 'weapon']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_weapon')" :data="$action" relation="weapon" name="id" tableName="weapon" related delete :edit="['page' =>'weapon.edit', 'main_route' => 'action.edit', 'id' => $action->id,'model' => 'action']"/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">18) {{ __('content.object_action_car') }}</label>
                            <a href="{{ route('open.page', ['page' => 'car', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'car']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_car')" :data="$action" relation="car" name="id" tableName="car" related delete  :edit="['page' =>'car.edit', 'main_route' => 'action.edit', 'id' => $action->id,'model' => 'action']"/>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="  form-control save_input_data" id="source_id" placeholder=""
                                    value="{{ $action->source }}" name="source" tabindex="10"
                                    data-type="update_field" />
                                <label for="source_id" class="form-label">19) {{ __('content.source_category') }}</label>
                            </div>
                        </div>


                        <div class="btn-div">
                            <label class="form-label">20) {{ __('content.checking_signal') }}</label>
                            <a href="{{ route('open.page', ['page' => 'signal', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'signal']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_signal')" :data="$action" relation="signal" name="id" tableName="signal" related delete :edit="['page' =>'signal.edit', 'main_route' => 'action.edit', 'id' => $action->id, 'model' => 'action']"/>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="  form-control save_input_data" id="opened_dou_id"
                                    placeholder="" value="{{ $action->opened_dou }}" name="opened_dou" tabindex="11"
                                    data-type="update_field" />
                                <label for="opened_dou_id" class="form-label">21) {{ __('content.opened_dou') }}</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">22) {{ __('content.criminal_case') }}</label>
                            <a  href="{{ route('open.page', ['page' => 'criminal_case', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'criminal_case']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_criminal')" :data="$action" relation="criminal_case" name="id" tableName="criminal_case"
                                related delete :edit="['page' =>'criminal_case.edit', 'main_route' => 'action.edit', 'id' => $action->id, 'model' => 'action']"/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">23) {{ __('content.place_action') }}</label>
                            <a  href="{{ route('open.page', ['page' => 'address', 'main_route' => 'action.edit','model' => 'action', 'model_id' => $action->id, 'relation' => 'address', 'updateRelation' => true]) }}">{{ __('content.addTo') }}</a>
                            <x-teg :item="$action" relation="address" name="id" tableName="address" related
                                   :label="__('content.short_address')" delete :edit="['page' =>'address.edit', 'main_route' => 'action.edit', 'id' => $action->id, 'model' => 'action', 'relation' => 'action']"/>

                        </div>

                        <div class="btn-div">
                            <label class="form-label">24) {{ __('content.contents_document') }}</label>
                            <div class="file-upload-content tegs-div">
                                <x-tegs :data="$action->bibliography" relation="files"  name="name"/>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select form-control select_class" id="selectElement">
                                    <option selected disabled value="" hidden></option>
                                    <option class="event_option" data-url="{{route('bibliography.summery_automatic',  ['bibliography_id' => $action->bibliography->id, 'table' => '	action_has_man', 'colum_name' => '	action_id', 'colum_name_id' => $action->id]) }}" value="1">{{ __('content.mia_summary_avto') }}</option>
                                    <option class="event_option" data-url="{{route('table-content.index', ['bibliography_id' => $action->bibliography->id, 'table' => '	action_has_man', 'colum_name' => '	action_id', 'colum_name_id' => $action->id]) }}" value="1">{{ __('content.table_avto') }}</option>
                                    <option class="event_option" data-url="{{route('reference', ['bibliography_id' => $action->bibliography->id, 'table' => '	action_has_man', 'colum_name' => '	action_id', 'colum_name_id' => $action->id])}}" value="1">{{ __('content.reference') }}</option>
                                </select>
                                <label class="form-label">25) {{ __('content.event_auto') }}</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">26) {{ __('content.ties') }}</label>
                            <x-teg name="id" :item="$action" relation="bibliography" :label="__('content.short_bibl')"
                                tableName="bibliography" related />
                        </div>
                        <!-- Vertical Form -->
                        <x-men  :parentModel="$action" relation="man"/>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-fullscreen-modal />
    <x-file-modal />
    <x-scroll-up />
    <x-large-modal :dataId="$action->id" />
    <x-errorModal />

@section('js-scripts')
    <script>
        let parent_id = "{{ $action->id }}"
        let updated_route = "{{ route('action.update', $action->id) }}"
        let delete_item = "{{ route('delete_tag') }}"
        let parent_table_name = "{{ __('content.action') }}"
    </script>
    <script src='{{ asset('assets/js/script.js') }}'></script>
    <script src='{{ asset('assets/js/more_info_popup.js') }}'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.1/mammoth.browser.min.js"></script>
    <script src="{{ asset('assets/js/tag.js') }}"></script>
    <script src="{{ asset('assets/js/select_options.js') }}"></script>
    <script src="{{ asset('assets/js/error_modal.js') }}"></script>
    <script src='{{ asset('assets/js/action/script.js') }}'></script>
    <script src='{{ asset('assets/js/main/date.js') }}'></script>

@endsection
@endsection
