@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/alarm/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection
@php
    $previous_url_name = app('router')
        ->getRoutes()
        ->match(app('request')->create(URL::previous()))
        ->getName();
@endphp
@inject('carbon', 'Carbon\Carbon')

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('content.passes_signal') }}</h1>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item">
                        @if ($previous_url_name == 'bibliography.edit')
                            <a
                                href="{{ route('bibliography.edit', $signal->bibliography_id) }}">{{ __('content.bibliography') . " ID: $signal->bibliography_id" }}</a>
                        @else
                            <a href="{{ route('open.page', 'signal') }}"> {{ __('content.signal') }}</a>
                        @endif
                    <li class="breadcrumb-item active">{{ __('content.signal') . " ID: $signal->id " }}</li>

                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                {{-- <p> id: {{ $signal->id }}</p> --}}

                <!-- Vertical Form -->
                <div class="form">
                    <div class="inputs row g-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data outline-red"
                                    value="{{ $signal->reg_num ?? null }}" name="reg_num" data-type="update_field"
                                    tabindex=1 />
                                <label for="item1" class="form-label">1) {{ __('content.reg_number_signal') }}</<
                                        /label>
                            </div>
                        </div>
                        {{-- {{dd($signal)}} --}}
                        <div class="btn-div col">
                            <label class="form-label">2) {{ __('content.contents_information_signal') }}</< /label>
                                <button class="btn btn-primary  model-id" data-model-id='{{ $signal->id }}'
                                    data-type='update_field' data-fieldName='content' style="font-size: 13px"
                                    data-bs-toggle="modal"data-bs-target="#additional_information">{{ __('content.addTo') }}</button>
                                @if ($signal->content !== null)
                                    <x-one-teg :item="$signal" :inputValue="$signal->content" />
                                @endif


                                <div class ="tegs-div">
                                    <div class="more_data"></div>
                                </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" id="item2"
                                    value="{{ $signal->check_line ?? null }}" name="check_line" data-type="update_field"
                                    tabindex=2 />
                                <label for="item2" class="form-label">3) {{ __('content.line_which_verified') }}</<
                                        /label>
                            </div>
                        </div>

                        <div class="btn-div col">
                            <label class="form-label">4) {{ __('content.check_status_charter') }}</< /label>
                                <button class="btn btn-primary  model-id" data-model-id='{{ $signal->id }}'
                                    data-type='update_field' data-fieldName='check_status' style="font-size: 13px"
                                    data-bs-toggle="modal"
                                    data-bs-target="#additional_information">{{ __('content.addTo') }}
                                </button>

                                @if ($signal->check_status !== null)
                                    <x-one-teg :item="$signal" :inputValue="$signal->check_status" />
                                @endif

                                <div class ="tegs-div">
                                </div>
                        </div>

                        <div class="col">
                            {{-- {{dd($signal->signal_qualification())}} --}}
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control fetch_input_title get_datalist save_input_data outline-red"
                                    value="{{ $signal->signal_qualification->name ?? null }}"
                                    name="signal_qualification_id"
                                    data-modelid="{{ $signal->signal_qualification_id ?? null }}" data-type="update_field"
                                    list="brow1" tabindex="3" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name='signal_qualification'
                                    data-fieldname ='name'></i>
                                <label for="item3" class="form-label">5) {{ __('content.qualifications_signaling') }}</<
                                        /label>
                            </div>
                            <datalist id="brow1" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control fetch_input_title get_datalist save_input_data outline-red"
                                    value="{{ $signal->resource->name ?? null }}" name="source_resource_id "
                                    data-modelid="{{ $signal->source_resource_id ?? null }}" data-type="update_field"
                                    list="brow2" tabindex="4" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name='resource' data-fieldname ='name'></i>
                                <label for="item4" class="form-label">6) {{ __('content.source_category') }}</< /label>
                            </div>
                            <datalist id="brow2" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control fetch_input_title get_datalist save_input_data outline-red"
                                    value="{{ $signal->agency_check_unit->name ?? null }}" name="check_unit_id"
                                    data-modelid="{{ $signal->check_unit_id ?? null }}" data-type="update_field"
                                    list="brow3" tabindex="5" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name='agency'
                                    data-fieldname ='name'></i>
                                <label for="item5" class="form-label">7) {{ __('content.checks_signal') }}</< /label>
                            </div>
                            <datalist id="brow3" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control fetch_input_title get_datalist save_input_data outline-red"
                                    value="{{ $signal->agency_check->name ?? null }}" name="check_agency_id "
                                    data-modelid="{{ $signal->check_agency_id ?? null }}" data-type="update_field"
                                    list="brow4" tabindex="6" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name='agency'
                                    data-fieldname ='name'></i>
                                <label for="item6" class="form-label">8) {{ __('content.department_checking') }}</<
                                        /label>
                            </div>
                            <datalist id="brow4" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control fetch_input_title get_datalist save_input_data outline-red"
                                    value="{{ $signal->agency_check_subunit->name ?? null }}" name="check_subunit_id"
                                    data-modelid="{{ $signal->check_agency_id ?? null }}" data-type="update_field"
                                    list="brow5" tabindex="7" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name='agency'
                                    data-fieldname ='name'></i>
                                <label for="item7" class="form-label">9) {{ __('content.unit_testing') }}</< /label>
                            </div>
                            <datalist id="brow5" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <x-tegs :data="$signal" :relation="'signal_checking_worker'" relationtype="has_many" :name="'worker'" delete />
                            <div class="form-floating">
                                <input type="text" class="form-control  save_input_data " name="worker"
                                    data-model="signal_checking_worker" {{-- wor tableum piti lcni --}}
                                    data-table="signal_checking_worker" data-type="create_relation"
                                    data-fieldname="worker" tabindex="8" />
                                <label for="item8" class="form-label">10) {{ __('content.name_checking_signal') }}</<
                                        /label>
                                    {{--  --}}
                            </div>
                        </div>

                        <div class="col">
                            <x-tegs :data="$signal" :relation="'checking_worker_post'" :name="'name'" delete />

                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    name="worker_post" data-type="attach_relation" data-model="Signal"
                                    data-table="checking_worker_post" data-fieldname ='name' list="brow6"
                                    tabindex="9" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name='worker_post'
                                    data-fieldname ='name'></i>
                                <label for="item9" class="form-label">11) {{ __('content.report_3') }}</< /label>
                            </div>
                            <datalist id="brow6" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">

                                <input type="date" value="{{ $signal->subunit_date ?? null }}" id="item10"
                                    class="form-control  save_input_data outline-red" name="subunit_date"
                                    data-type="update_field" tabindex="10" />
                                <label for="item10" class="form-label">12)
                                    {{ __('content.date_registration_division') }}</< /label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" value="{{ $signal->check_date ?? null }}" id="item11"
                                    class="form-control save_input_data outline-red" name="check_date"
                                    data-type="update_field" tabindex="11" />
                                <label for="item11" class="form-label">13) {{ __('content.check_date') }}</< /label>
                            </div>
                        </div>

                        <div class="col">
                            <x-tegs :data="$signal" :relation="'signal_check_date'" :name="'date'" delete />

                            <div class="form-floating input-date-wrapper">

                                <input type="date" id="item12"
                                    class="form-control my-form-control-class my-teg-class save_input_data" name="date"
                                    data-type="create_relation" data-model="signal_check_date" data-table="check_date"
                                    tabindex="12" />
                                <label for="item12" class="form-label">14) {{ __('content.check_previously') }}</<
                                        /label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" id="item13" value="{{ $signal->end_date ?? null }}"
                                    class="form-control fetch_input_title get_datalist save_input_data"
                                    data-type="update_field" name="end_date" tabindex="13" />
                                <label for="item13" class="form-label">15) {{ __('content.date_actual') }}</< /label>
                            </div>
                        </div>

                        <div class="col">

                            <div class="form-floating">
                                <input disabled type="text" class="form-control " id="item14" placeholder=""
                                    value="{{ $signal->count_number() }}" name="short_desc" />
                                <label for="item14" class="form-label">16) {{ __('content.amount_overdue') }}</<
                                        /label>
                            </div>
                        </div>
                        {{-- {{dd($signal->signal_used_resource)}} --}}
                        <div class="col">
                            <x-tegs :data="$signal" :relation="'used_resource'" :name="'name'" delete />
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title get_datalist save_input_data"
                                    id="item15" name = "resource" data-type = "attach_relation"
                                    data-model = "Resource" data-table = "used_resource" data-fieldname="name"
                                    {{-- data-pivot-table = "signal_used_resource" --}} list="brow7" tabindex="14" />
                                <i class = "bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle = "modal"
                                    data-bs-target = "#fullscreenModal" data-table-name = "resource"
                                    data-fieldname = "name"></i>
                                <label for="item15" class="form-label">17) {{ __('content.useful_capabilities') }}</<
                                        /label>
                            </div>
                            <datalist id="brow7" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>


                        <div class="col">
                            <div class="form-floating">
                                <input type="text"
                                    class = "form-control fetch_input_title get_datalist save_input_data"
                                    name = "signal_result_id" data-type = "update_field"
                                    value="{{ $signal->signal_result->name ?? null }}" tabindex="15" list="brow8" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name = "signal_result"
                                    data-fieldname = "name"></i>
                                <label for="item16" class="form-label">18) {{ __('content.signal_results') }}</<
                                        /label>
                            </div>
                            <datalist id="brow8" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <x-tegs :data="$signal" :relation="'has_taken_measure'" :name="'name'" />

                            <div class="form-floating">
                                <input type="text"
                                    class = "form-control fetch_input_title get_datalist save_input_data"
                                    name= "taken_measure" data-type = "attach_relation" data-model = "TakenMeasure"
                                    data-table = "has_taken_measure" data-fieldname="name" tabindex="16"
                                    list="brow9" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name="taken_measure"
                                    data-fieldname = "name"></i>
                                <label for="item17" class="form-label">19) {{ __('content.measures_taken') }}</label>
                            </div>
                            <datalist id="brow9" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control  save_input_data" data-type="update_field"
                                    name="opened_dou" tabindex="17" value="{{ $signal->opened_dou ?? null }}" />
                                <label for="item18" class="form-label">20)
                                    {{ __('content.according_result_dow') }}</label>
                            </div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">21) {{ __('content.according_test_result') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'criminal_case', 'main_route' => 'signal.edit', 'model_id' => $signal->id, 'relation' => 'criminal_case']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :name="'id'" :data="$signal" :relation="'criminal_case'" :label="__('content.short_criminal') . ': '"
                                tableName="criminal_cas" related edit delete />

                        </div>
                        <div class="btn-div">
                            <label class="form-label">22) {{ __('content.objects_check_signal_man') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'man', 'main_route' => 'signal.edit', 'model_id' => $signal->id, 'relation' => 'man']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :name="'id'" :data="$signal" :relation="'man'" :label="__('content.short_man') . ': '"
                                tableName="man" related delete />

                        </div>

                        <div class="btn-div">
                            <label class="form-label">23) {{ __('content.objects_check_signal_organization') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'organization', 'main_route' => 'signal.edit', 'model_id' => $signal->id, 'relation' => 'organization_checked_by_signal']) }}">{{ __('content.addTo') }}</a>

                            <x-tegs :name="'id'" :data="$signal" :relation="'organization_checked_by_signal'" :label="__('content.short_organ') . ': '"
                                tableName="organization" related delete />

                        </div>

                        <div class="btn-div">
                            <label class="form-label">24) {{ __('content.objects_check_signal_action') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'action', 'main_route' => 'signal.edit', 'model_id' => $signal->id, 'relation' => 'action_passes_signal']) }}">{{ __('content.addTo') }}</a>

                            <x-tegs :name="'id'" :data="$signal" :relation="'action_passes_signal'" :label="__('content.short_action') . ': '"
                                tableName="action" related delete />

                        </div>

                        <div class="btn-div">
                            <label class="form-label">25) {{ __('content.objects_check_signal_event') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'event', 'main_route' => 'signal.edit', 'model_id' => $signal->id, 'relation' => 'event']) }}">{{ __('content.addTo') }}</a>

                            <x-tegs :name="'id'" :data="$signal" :relation="'event'" :label="__('content.short_event') . ': '"
                                tableName="event" related delete />

                        </div>

                        <div class="btn-div">

                            <label class="form-label">26) {{ __('content.passes_signal') }}</label>

                            <a
                                href="{{ route('open.page', ['page' => 'man', 'main_route' => 'signal.edit', 'model_id' => $signal->id, 'relation' => 'man_passed_by_signal']) }}">{{ __('content.addTo') }}</a>

                            <x-tegs :name="'id'" :data="$signal" :relation="'man_passed_by_signal'" :label="__('content.short_man') . ': '"
                                tableName="man" related delete />

                        </div>

                        <div class="btn-div">
                            <label class="form-label">27) {{ __('content.passes_signal_organization') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'organization', 'main_route' => 'signal.edit', 'model_id' => $signal->id, 'relation' => 'organization_checked_by_signal']) }}">{{ __('content.addTo') }}</a>

                            <x-tegs :name="'id'" :data="$signal" :relation="'organization_checked_by_signal'" :label="__('content.short_organ') . ': '"
                                tableName="organization" related edit delete />

                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control fetch_input_title get_datalist save_input_data outline-red"
                                    id="item19" value="{{ $signal->opened_agency->name ?? null }}"
                                    data-type="update_field" name="opened_agency_id" data-fieldname='name'
                                    list="brow10" tabindex="18" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name="agency" data-fieldname='name'></i>
                                <label for="item19" class="form-label">28) {{ __('content.brought_signal') }}</label>
                            </div>
                            <datalist id="brow10" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control fetch_input_title get_datalist save_input_data outline-red"
                                    id="item20" value="{{ $signal->opened_unit->name ?? null }}"
                                    data-type="update_field" name="opened_unit_id" data-fieldname='name' list="brow11"
                                    tabindex="19" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name="agency" data-fieldname='name'></i>
                                <label for="item20" class="form-label">29)
                                    {{ __('content.department_brought') }}</label>
                            </div>
                            <datalist id="brow11" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control fetch_input_title get_datalist save_input_data outline-red"
                                    id="item21" value="{{ $signal->opened_subunit->name ?? null }}"
                                    data-type="update_field" name="opened_subunit_id" data-fieldname='name'
                                    list="brow12" tabindex="20" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name="agency" data-fieldname='name'></i>
                                <label for="item21" class="form-label">30) {{ __('content.unit_brought') }}</label>
                            </div>
                            <datalist id="brow12" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <x-tegs :data="$signal" :relation="'signal_worker'" relationtype="has_many" :name="'worker'"
                                delete />
                            <div class="form-floating">
                                <input type="text" class="form-control  save_input_data get_datalist" id="item22"
                                    placeholder="" name="worker" data-type="create_relation" data-model="signal_worker"
                                    {{-- wor tableum piti lcni --}} tabindex="21" data-fieldname='worker' />
                                <label for="item22" class="form-label">31) {{ __('content.name_operatives') }}</label>
                            </div>
                        </div>

                        <div class="col">

                            <x-tegs :data="$signal" :relation="'signal_worker_post'" :name="'name'" delete />

                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    data-type="attach_relation" data-model="Signal" data-table="worker_post"
                                    list="brow13" tabindex="22" data-fieldname='name' />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name="worker_post"
                                    data-fieldname='name'></i>
                                <label for="item23" class="form-label">32) {{ __('content.worker_post') }}</label>
                            </div>
                            <datalist id="brow13" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <x-tegs :name="'id'" :data="$signal" :relation="'keep_signal'" :label="__('content.short_keep_signal') . ': '" edit delete />


                        <div class="btn-div">
                            <label class="form-label">33) {{ __('content.keep_signal') }}</label>
                            <a
                                href="{{ route('keepSignal.create', ['lang' => app()->getLocale(), 'signal_id' => $signal->id]) }}">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn10"></div>
                        </div>

                        <x-tegs :name="'id'" :data="$signal->bibliography" :relation="'files'" :label="__('content.file') . ': '" />

                        <div class="btn-div">
                            <label class="form-label">34) {{ __('content.contents_document') }}</label>
                            <div class="file-upload-content tegs-div">

                            </div>
                        </div>
                        {{-- {{dd($signal->bibliography())}} --}}

                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select form-control select_class" id="selectElement">
                                    <option selected disabled value="" hidden></option>
                                    <option class="event_option" data-url="" value="1">
                                        {{ __('content.event_table') }}</option>
                                    <option class="event_option" data-url="" value="1">
                                        {{ __('content.event_sumery') }}</option>

                                </select>

                                <label class="form-label">35) {{ __('content.event_auto') }}</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">36) {{ __('content.ties') }}</label>
                            <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police">
                                <x-teg :name="'id'" :item="$signal->bibliography" inputName="bibliography"
                                    inputValue="$signal->bibliography_id" :label="__('content.short_bibl')" tableName="bibliography"
                                    related />
                            </div>
                        </div>

                        <!-- Vertical Form -->

                    </div>
    </section>

    <x-scroll-up />
    <x-fullscreen-modal />
    <x-errorModal />
    <x-file-modal />

@section('js-scripts')
    <script>
        let updated_route = `{{ route('signal.update', $signal->id) }}`
        let delete_item = "{{ route('delete_tag') }}"
        let parent_id = "{{ $signal->id }}"
        let ties = "{{ __('content.ties') }}"
        let parent_table_name = "{{ __('content.signal') }}"
    </script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/tag.js') }}"></script>
    <script src="{{ asset('assets/js/error_modal.js') }}"></script>

    <script src='{{ asset('assets/js/append_doc_content.js') }}'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.1/mammoth.browser.min.js"></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
@endsection
@endsection
