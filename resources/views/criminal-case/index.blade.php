@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/criminalCase/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/calendar.css') }}">


@endsection

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
                                <input type="text" class="form-control save_input_data" id="number" placeholder=""
                                    value="{{ $criminal_case->number ?? null }}" name="number" tabindex="1"
                                    data-type="update_field" />
                                <label for="number" class="form-label">1) {{ __('content.number_case') }}</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">2) {{ __('content.case_person') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'man', 'main_route' => 'criminal_case.edit', 'model_id' => $criminal_case->id, 'relation' => 'man']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs name="id" :data="$criminal_case" relation="man" :label="__('content.short_man')" tableName="man"
                                related :edit="[
                                    'page' => 'man.edit',
                                    'main_route' => 'criminal_case.edit',
                                    'id' => $criminal_case->id,
                                    'model' => 'criminal_case',
                                ]" delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">3) {{ __('content.case_organization') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'organization', 'main_route' => 'criminal_case.edit', 'model_id' => $criminal_case->id, 'relation' => 'organization']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs name="id" :data="$criminal_case" relation="organization" :label="__('content.short_organ')"
                                tableNmae="organization" related :edit="[
                                    'page' => 'organization.edit',
                                    'main_route' => 'criminal_case.edit',
                                    'id' => $criminal_case->id,
                                    'model' => 'criminal_case',
                                ]" delete />
                        </div>



                        <div class="col">
                            <div class="form-floating input-date-wrapper calendar-container">
                                <input type="text" data-check="date" placeholder="" value="{{ $criminal_case->opened_date ?? null }}"
                                    id="opened_date" tabindex="2" data-type="update_field"
                                    class="form-control save_input_data calendarInput" name="opened_date"
                                    autocomplete="off" onblur="handleBlur(this)" />
                                    <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>
                                <label for="opened_date" class="form-label">4)
                                    {{ __('content.criminal_proceedings_date') }}</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" placeholder="" value="{{ $criminal_case->artical ?? null }}"
                                    id="artical" tabindex="3" data-type="update_field"
                                    class="form-control save_input_data" name="artical" />
                                <label for="artical" class="form-label">5) {{ __('content.criminal_code') }}</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="agency" value="{{ $criminal_case->opened_agency->name ?? null }}"
                                    data-modelid="{{ $criminal_case->opened_agency->id ?? null }}" name="opened_agency_id"
                                    tabindex="4" data-type="update_field" list="agency-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='agency' data-fieldname='name'></i>
                                <label for="agency" class="form-label">6) {{ __('content.head_department') }}</label>
                            </div>
                            <datalist id="agency-list" class="input_datalists" style="width: 500px;"> </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="opened_unit_agency" value="{{ $criminal_case->opened_unit_agency->name ?? null }}"
                                    data-modelid="{{ $criminal_case->opened_unit_agency->id ?? null }}"
                                    name="opened_unit_id" tabindex="5" data-type="update_field"
                                    list="opened_unit_agency-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='agency' data-fieldname='name'></i>
                                <label for="opened_unit_agency" class="form-label">7)
                                    {{ __('content.materials_management') }}</label>
                            </div>
                            <datalist id="opened_unit_agency-list" class="input_datalists" style="width: 500px;">
                            </datalist>

                        </div>

                        <div class="col">

                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="subunit_id" value="{{ $criminal_case->subunit_agency->name ?? null }}"
                                    data-modelid="{{ $criminal_case->subunit_agency->id ?? null }}" name="subunit_id"
                                    tabindex="6" data-type="update_field" list="subunit_id-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='agency' data-fieldname='name'></i>
                                <label for="subunit_id" class="form-label">8)
                                    {{ __('content.instituted_units') }}</label>
                            </div>
                            <datalist id="subunit_id-list" class="input_datalists" style="width: 500px;"> </datalist>

                        </div>

                        <div class="col">
                            <x-tegs :data="$criminal_case" relation="worker" name="worker" relationtype="has_many" delete />
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control my-form-control-class my-teg-class save_input_data" id="worker"
                                    name="worker" tabindex="7" data-type="create_relation"
                                    data-table="criminal_case_worker" data-model="Worker" data-fieldname='worker'
                                    data-parent-model-name='CriminalCase' data-pivot-table='criminal_case_worker' />

                                <label for="worker" class="form-label">
                                    9) {{ __('content.name_operatives') }}</label>
                            </div>
                        </div>

                        <div class="col">
                            <x-tegs :data="$criminal_case" relation="worker_post" name="name" delete />
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="worker_post" name="qualification_id" tabindex="8" list="worker_post-list"
                                    data-type="attach_relation" data-table="worker_post" data-model="WorkerPost"
                                    data-fieldname='name' data-parent-model-name='Event'
                                    data-pivot-table='worker_post' />

                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name='worker_post'
                                    data-fieldname='name'></i>
                                <label for="worker_post" class="form-label">
                                    10) {{ __('content.worker_post') }}</label>
                            </div>
                            <datalist id="worker_post-list" class="input_datalists" style="width: 500px;"> </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" placeholder="" value="{{ $criminal_case->character ?? null }}"
                                    id="character" tabindex="9" data-type="update_field"
                                    class="form-control save_input_data" name="character" />
                                <label for="character" class="form-label">11)
                                    {{ __('content.nature_materials_paint') }}</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">12) {{ __('content.instituted_fact') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'action', 'main_route' => 'criminal_case.edit', 'model_id' => $criminal_case->id, 'relation' => 'action']) }}">{{ __('content.addTo') }}</a>

                            <x-tegs name="id" :data="$criminal_case" relation="action" :label="__('content.short_action')"
                                tableNmae="action" related :edit="[
                                    'page' => 'action.edit',
                                    'main_route' => 'criminal_case.edit',
                                    'id' => $criminal_case->id,
                                    'model' => 'criminal_case',
                                ]" delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">13) {{ __('content.instituted_fact_event') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'event', 'main_route' => 'criminal_case.edit', 'model_id' => $criminal_case->id, 'relation' => 'event']) }}">{{ __('content.addTo') }}</a>

                            <x-tegs name="id" :data="$criminal_case" relation="event" :label="__('content.short_event')"
                                tableNmae="event" related :edit="[
                                    'page' => 'event.edit',
                                    'main_route' => 'criminal_case.edit',
                                    'id' => $criminal_case->id,
                                    'model' => 'criminal_case',
                                ]" delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">14) {{ __('content.results_inspection_signal') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'signal', 'main_route' => 'criminal_case.edit', 'model_id' => $criminal_case->id, 'relation' => 'signal']) }}">{{ __('content.addTo') }}</a>

                            <x-tegs name="id" :data="$criminal_case" relation="signal" :label="__('content.short_signal')"
                                tableNmae="signal" related :edit="[
                                    'page' => 'signal.edit',
                                    'main_route' => 'criminal_case.edit',
                                    'id' => $criminal_case->id,
                                    'model' => 'criminal_case',
                                ]" delete />
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" placeholder="" value="{{ $criminal_case->opened_dou ?? null }}"
                                    id="opened_dou" tabindex="10" data-type="update_field"
                                    class="form-control save_input_data" name="opened_dou" />
                                <label for="opened_dou" class="form-label">15) {{ __('content.initiated_dow') }}</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">16) {{ __('content.connected_criminal_cases') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'criminal_case', 'main_route' => 'criminal_case.edit', 'model_id' => $criminal_case->id, 'relation' => 'criminal_case_splited']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs name="id" :data="$criminal_case" relation="criminal_case_splited" :label="__('content.short_criminal')"
                                tableNmae="criminal_case" related :edit="[
                                    'page' => 'criminal_case.edit',
                                    'main_route' => 'criminal_case.edit',
                                    'id' => $criminal_case->id,
                                    'model' => 'criminal_case',
                                ]" delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">17) {{ __('content.separated_criminal_cases') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'criminal_case', 'main_route' => 'criminal_case.edit', 'model_id' => $criminal_case->id, 'relation' => 'criminal_case_extracted']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs name="id" :data="$criminal_case" relation="criminal_case_extracted"
                                :label="__('content.short_criminal')" tableNmae="criminal_case" related :edit="[
                                    'page' => 'criminal_case.edit',
                                    'main_route' => 'criminal_case.edit',
                                    'id' => $criminal_case->id,
                                    'model' => 'criminal_case',
                                ]" delete />
                        </div>


                        <div class="btn-div">
                            <label class="form-label">18) {{ __('content.contents_document') }}</label>
                            <div class="file-upload-content tegs-div">
                                <x-tegs name="name" :data="$criminal_case->bibliography" relation="files" />

                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select form-control select_class" id="selectElement">
                                    <option selected disabled value="" hidden></option>
                                    <option class="event_option" data-url="{{route('bibliography.summery_automatic', ['bibliography_id' => $criminal_case->bibliography->id, 'table' => 'criminal_case_has_man', 'colum_name' => 'criminal_case_id', 'colum_name_id' => $criminal_case->id]) }}" value="1">{{ __('content.mia_summary_avto') }}</option>
                                    <option class="event_option"
                                        data-url="{{ route('table-content.index', ['bibliography_id' => $criminal_case->bibliography->id, 'table' => 'criminal_case_has_man', 'colum_name' => 'criminal_case_id', 'colum_name_id' => $criminal_case->id]) }}"
                                        value="1">{{ __('content.table_avto') }}</option>
                                    <option class="event_option"
                                        data-url="{{ route('reference', ['bibliography_id' => $criminal_case->bibliography->id, 'table' => 'criminal_case_has_man', 'colum_name' => 'criminal_case_id', 'colum_name_id' => $criminal_case->id]) }}"
                                        value="1">{{ __('content.reference') }}</option>

                                </select>

                                <label class="form-label">19) {{ __('content.event_auto') }}</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">20) {{ __('content.ties') }}</label>
                            <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police">
                                <x-teg name="id" :item="$criminal_case" relation="bibliography" :label="__('content.short_bibl')"
                                    tableName="bibliography" related :edit="[
                                        'page' => 'bibliography.edit',
                                        'main_route' => 'criminal_case.edit',
                                        'id' => $criminal_case->id,
                                        'model' => 'criminal_case',
                                    ]" />

                            </div>
                        </div>

                    </div>
                </form>
                <!-- Vertical Form -->
                <x-men :parentModel="$criminal_case" relation="man" />

            </div>
        </div>
    </section>

    <x-scroll-up />
    <x-fullscreen-modal />
    <x-errorModal />

@section('js-scripts')
    <script>
        let parent_id = "{{ $criminal_case->id }}"
        let updated_route = "{{ route('criminal_case.update', $criminal_case->id) }}"
        let delete_item = "{{ route('delete_tag') }}"
        let parent_table_name = "{{ __('content.criminal_case') }}"
    </script>
    <script src='{{ asset('assets/js/script.js') }}'></script>
    <script src="{{ asset('assets/js/tag.js') }}"></script>
    <script src="{{ asset('assets/js/select_options.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.1/mammoth.browser.min.js"></script>
    <script src="{{ asset('assets/js/error_modal.js') }}"></script>
    <script src='{{ asset('assets/js/criminalCase/script.js') }}'></script>
    <script src='{{ asset('assets/js/main/date.js') }}'></script>

@endsection
@endsection
