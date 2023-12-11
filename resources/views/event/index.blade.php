@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/event/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')
    <!-- End Page Title -->

    <section class="section" id="section" data-model="event">
        <div class="card">
            <div class="card-body">
                <!-- Vertical Form -->
                <x-back-previous-url/>
                <div class="form">
                    <div class="inputs row g-3">
                        <div class="col">
                            <x-tegs :data="$event" relation="event_qualification" name="name" delete />
                            <div class="form-floating">
                                <input style='outline:3px solid red;' type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="event_qualification" name="qualification_id" tabindex="1"
                                    list="event_qualification-list" data-type="attach_relation"
                                    data-table="event_qualification" data-model="EventQualification" data-fieldname='name'
                                    data-parent-model-name='Event' data-pivot-table='event_qualification' />

                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name='event_qualification'
                                    data-fieldname='name'></i>
                                <label for="event_qualification" class="form-label">
                                    1) {{ __('content.qualification_event') }}</label>
                            </div>
                            <datalist id="event_qualification-list" class="input_datalists" style="width: 500px;">
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">

                                <input type="date" placeholder=""
                                    value="{{ $event->date ? date('Y-m-d', strtotime($event->date)) : null }}"
                                    id="item2" tabindex="2" data-type="update_field"
                                    class="form-control save_input_data" name="date" />
                                <label for="item2" class="form-label">2) {{ __('content.date_security_date') }}</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">

                                <input id="item3" type="time" placeholder=""
                                    value="{{ $event->date && date('H:i', strtotime($event->date)) != '00:00' ? date('H:i', strtotime($event->date)) : null }}"
                                    tabindex="3" data-type="update_field" class="form-control save_input_data"
                                    name="time" />
                                <label for="item3" class="form-label">3) {{ __('content.date_security_time') }}</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">4) {{ __('content.place_event_address') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'address', 'main_route' => 'event.edit', 'model_id' => $event->id, 'model_name' => 'event', 'relation' => 'address']) }}">{{ __('content.addTo') }}</a>
                            <x-teg :item="$event->address" inputName="address_id" :label="__('content.short_address')" tableName="address" related
                                delete :edit="['page' =>'address.edit', 'main_route' => 'event.edit', 'id' => $event->id, 'model' => 'event']"/>

                        </div>

                        <div class="btn-div">
                            <label class="form-label">5) {{ __('content.place_event_organization') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'organization', 'relation' => 'organization', 'main_route' => 'event.edit', 'model_id' => $event->id]) }}">{{ __('content.addTo') }}</a>
                            <x-teg :item="$event->organization" inputName="organization_id" :label="__('content.short_organ')" tableName="organization"
                                related :edit="['page' =>'organization.edit', 'main_route' => 'event.edit', 'id' => $event->id, 'model' => 'event']" delete />
                        </div>


                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="aftermath" placeholder="" value="{{ $event->aftermath->name ?? null }}"
                                    data-modelid="{{ $event->aftermath->id ?? null }}" name="aftermath_id" tabindex="4"
                                    data-type="update_field" list="aftermath-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='aftermath' data-fieldname='name'></i>
                                <label for="item4" class="form-label">6) {{ __('content.ensuing_effects') }}</label>
                            </div>
                            <datalist id="aftermath-list" class="input_datalists" style="width: 500px;"> </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="agency" placeholder="" value="{{ $event->agency->name ?? null }}"
                                    data-modelid="{{ $event->agency->id ?? null }}" name="agency_id" tabindex="5"
                                    data-type="update_field" list="agency-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='agency' data-fieldname='name'></i>
                                <label for="item5" class="form-label">7)
                                    {{ __('content.investigation_requested') }}</label>
                            </div>
                            <datalist id="agency-list" class="input_datalists" style="width: 500px;"> </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">

                                <input type="text" class="form-control save_input_data" id="result" placeholder=""
                                    value="{{ $event->result ?? null }}" name="result" tabindex="6"
                                    data-type="update_field" />
                                <label for="item6" class="form-label">8) {{ __('content.results_event') }}</label>
                            </div>
                        </div>


                        <div class="btn-div">
                            <label class="form-label">9) {{ __('content.involved_events_man') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'man', 'relation' => 'man', 'main_route' => 'event.edit', 'model_id' => $event->id]) }}">{{ __('content.addTo') }}</a>

                            <x-tegs name="id" :data="$event" relation="man" :label="__('content.short_man')" tableName="man"
                                related :edit="['page' =>'man.edit', 'main_route' => 'event.edit', 'id' => $event->id, 'model' => 'event']" delete />
                        </div>


                        <div class="btn-div">
                            <label class="form-label">10) {{ __('content.involved_events_organization') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'organization', 'relation' => 'organizations', 'main_route' => 'event.edit', 'model_id' => $event->id]) }}">{{ __('content.addTo') }}</a>

                            <x-tegs name="id" :data="$event" relation="organizations" :label="__('content.short_organ')"
                                tableName="organization" related :edit="['page' =>'organization.edit', 'main_route' => 'event.edit', 'id' => $event->id, 'model' => 'event']" delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">11) {{ __('content.involved_events_car') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'car', 'relation' => 'car', 'main_route' => 'event.edit', 'model_id' => $event->id]) }}">{{ __('content.addTo') }}</a>
                            <x-tegs name="id" :data="$event" relation="car" :label="__('content.short_car')" tableName="car"
                                related :edit="['page' =>'car.edit', 'main_route' => 'event.edit', 'id' => $event->id, 'model' => 'event']" delete />

                        </div>


                        <div class="btn-div">
                            <label class="form-label">12) {{ __('content.involved_events_weapon') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'weapon', 'relation' => 'weapon', 'main_route' => 'event.edit', 'model_id' => $event->id]) }}">{{ __('content.addTo') }}</a>

                            <x-tegs name="id" :data="$event" relation="weapon" :label="__('content.short_weapon')"
                                tableName="weapon" related :edit="['page' =>'weapon.edit', 'main_route' => 'event.edit', 'id' => $event->id, 'model' => 'event']" delete />
                        </div>


                        <div class="btn-div">
                            <label class="form-label">13) {{ __('content.involved_events_action') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'action', 'relation' => 'action', 'main_route' => 'event.edit', 'model_id' => $event->id]) }}">{{ __('content.addTo') }}</a>

                            <x-tegs name="id" :data="$event" relation="action" :label="__('content.short_action')"
                                tableName="action" related :edit="['page' =>'action.edit', 'main_route' => 'event.edit', 'id' => $event->id, 'model' => 'event']" delete />
                        </div>


                        <div class="btn-div">
                            <label class="form-label">14) {{ __('content.criminal_case') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'criminal_case', 'relation' => 'criminal_case', 'main_route' => 'event.edit', 'model_id' => $event->id]) }}">{{ __('content.addTo') }}</a>
                            <x-tegs name="id" :data="$event" relation="criminal_case" :label="__('content.short_criminal')"
                                tableName="criminal_case" related :edit="['page' =>'criminal_case.edit', 'main_route' => 'event.edit', 'id' => $event->id, 'model' => 'event']" delete />
                        </div>


                        <div class="btn-div">
                            <label class="form-label">15) {{ __('content.checking_signal') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'signal', 'relation' => 'signal', 'main_route' => 'event.edit', 'model_id' => $event->id]) }}">{{ __('content.addTo') }}</a>

                            <x-tegs name="id" :data="$event" relation="signal" :label="__('content.short_signal')"
                                tableName="signal" related :edit="['page' =>'signal.edit', 'main_route' => 'event.edit', 'id' => $event->id, 'model' => 'event']" delete />
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="resource" placeholder="" value="{{ $event->resource->name ?? null }}"
                                    data-modelid="{{ $event->resource->id ?? null }}" name="resource_id" tabindex="7"
                                    data-type="update_field" list="resource-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='resource' data-fieldname='name'></i>
                                <label for="item6" class="form-label">16) {{ __('content.source_event') }}</label>
                            </div>
                            <datalist id="resource-list" class="input_datalists" style="width: 500px;"> </datalist>
                        </div>


                        <div class="btn-div">
                            <label class="form-label">17) {{ __('content.event_associated_action') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'action', 'relation' => 'associated_action', 'main_route' => 'event.edit', 'model_id' => $event->id]) }}">{{ __('content.addTo') }}</a>

                            <x-tegs name="id" :data="$event" relation="associated_action" :label="__('content.short_action')"
                                tableName="action" related :edit="['page' =>'action.edit', 'main_route' => 'event.edit', 'id' => $event->id, 'model' => 'event']" delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">18) {{ __('content.contents_document') }}</label>
                            <div class="file-upload-content tegs-div">
                                <x-tegs name="name" :data="$event->bibliography" relation="files" />
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select form-control select_class" id="selectElement">
                                    <option selected disabled value="" hidden></option>
                                    <option class="event_option" data-url="{{route('bibliography.summery_automatic', ['bibliography_id' => $event->bibliography->id, 'table' => 'event_has_man', 'colum_name' => 'event_id', 'colum_name_id' => $event->id]) }}" value="1">{{ __('content.mia_summary_avto') }}</option>
                                    <option class="event_option" data-url="{{route('table-content.index', ['bibliography_id' => $event->bibliography->id, 'table' => 'event_has_man', 'colum_name' => 'event_id', 'colum_name_id' => $event->id]) }}" value="1">{{ __('content.table_avto') }}</option>
                                    <option class="event_option" data-url="{{route('reference', ['bibliography_id' => $event->bibliography->id, 'table' => 'event_has_man', 'colum_name' => 'event_id', 'colum_name_id' => $event->id])}}" value="1">{{ __('content.reference') }}</option>

                                </select>

                                <label class="form-label">19) {{ __('content.event_auto') }}</label>
                            </div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">20) {{ __('content.ties') }}</label>
                            <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police">
                                <x-teg name="id" :item="$event" inputName="bibliography" :label="__('content.short_bibl')"
                                    tableName="bibliography" related :edit="['page' =>'bibliography.edit', 'main_route' => 'event.edit', 'id' => $event->id, 'model' => 'event']" />
                            </div>

                        </div>
                        <!-- Vertical Form -->
                    </div>
                </div>
                </div>
                </div>
                <x-men  :parentModel="$event" relation="man"/>
    </section>

    <x-scroll-up />
    <x-fullscreen-modal />
    <x-errorModal />

@section('js-scripts')
    <script>
        let parent_id = "{{ $event->id }}"

        let updated_route = "{{ route('event.update', $event->id) }}"
        let delete_item = "{{ route('delete_tag') }}"
        let ties = "{{ __('content.ties') }}"
        let parent_table_name = "{{ __('content.event') }}"
    </script>
    <script src='{{ asset('assets/js/script.js') }}'></script>
    <script src="{{ asset('assets/js/tag.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.1/mammoth.browser.min.js"></script>
    <script src="{{ asset('assets/js/error_modal.js') }}"></script>
    <script src="{{ asset('assets/js/select_options.js') }}"></script>
    <script src='{{ asset('assets/js/event/script.js') }}'></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
@endsection
@endsection
