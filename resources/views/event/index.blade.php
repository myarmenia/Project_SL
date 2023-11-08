@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/event/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('content.event') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item">{{ __('content.event') }}</li>
                    <li class="breadcrumb-item active">ID: {{ $event->id }}</li>

                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section" id="section" data-model="event">
        <div class="card">
            <div class="card-body">

                <!-- Vertical Form -->

                <div class="form">
                    <div class="inputs row g-3">
                        <div class="col">

                            <x-tegs :data="$event" :relation="'event_qualification'" name="name" />

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
                                <label for="item2" class="form-label">2) Իրադարձության ամսաթիվ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">

                                <input id="item3" type="time" placeholder=""
                                    value="{{ $event->date && date('H:i', strtotime($event->date)) != '00:00' ? date('H:i', strtotime($event->date)) : null }}"
                                    tabindex="3" data-type="update_field" class="form-control save_input_data"
                                    name="time" />
                                <label for="item3" class="form-label">3) Իրադարձության ժամ</label>
                            </div>
                        </div>

                        <x-teg :item="$event->address" inputName="address_id" :label="__('content.short_address')" edit/>
                        <div class="btn-div">
                            <label class="form-label">4) Իրադարձության վայր հասցե</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'address', 'relation' => 'address']) }}">Ավելացնել</a>
                        </div>

                        <x-teg :item="$event->organization" inputName="organization_id" :label="__('content.short_organ')" edit />
                        <div class="btn-div">
                            <label class="form-label">5) Միջոցառման անցկացման վայրը(կազմակերպություն)</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'organization', 'relation' => 'organization']) }}">Ավելացնել</a>
                        </div>


                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="aftermath" placeholder="" value="{{ $event->aftermath->name ?? null }}"
                                    data-modelid="{{ $event->aftermath->id ?? null }}" name="aftermath_id" tabindex="6"
                                    data-type="update_field" list="aftermath-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='aftermath' data-fieldname='name'></i>
                                <label for="item4" class="form-label">6) Իրադարձության (հնարավոր) հետևանքները</label>
                            </div>
                            <datalist id="aftermath-list" class="input_datalists" style="width: 500px;"> </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="agency" placeholder="" value="{{ $event->agency->name ?? null }}"
                                    data-modelid="{{ $event->agency->id ?? null }}" name="agency_id" tabindex="7"
                                    data-type="update_field" list="agency-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='agency' data-fieldname='name'></i>
                                <label for="item5" class="form-label">7) Հետաքննությունը հանձնարարված է</label>
                            </div>
                            <datalist id="agency-list" class="input_datalists" style="width: 500px;"> </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">

                                <input type="text" class="form-control save_input_data" id="result" placeholder=""
                                    value="{{ $event->result ?? null }}" name="result" tabindex="8"
                                    data-type="update_field" />
                                <label for="item6" class="form-label">8) Իրադարձության հետաքննության
                                    արդյունքները</label>
                            </div>
                        </div>

                        <x-tegs :name="'id'" :data="$event" :relation="'man'" :label="__('content.short_man') . ': '" edit />
                        <div class="btn-div">
                            <label class="form-label">9) Իրադարձությանն առնչություն ունեցող անձինք</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'man', 'relation' => 'man']) }}">Ավելացնել</a>
                        </div>

                        <x-tegs :name="'id'" :data="$event" :relation="'organizations'" :label="__('content.short_organ') . ': '" edit />
                        <div class="btn-div">
                            <label class="form-label">10) Իրադարձությանն առնչություն ունեցող կազմակերպություն</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'organization', 'relation' => 'organizations']) }}">Ավելացնել</a>
                        </div>

                        <x-tegs name="id" :data="$event" relation="car" :label="__('content.short_car') . ': '" edit />
                        <div class="btn-div">
                            <label class="form-label">11) Իրադարձությանն առնչություն ունեցող ավտոմեքենա</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'car', 'relation' => 'car']) }}">Ավելացնել</a>
                        </div>

                        <x-tegs name="id" :data="$event" relation="weapon" :label="__('content.short_weapon') . ': '" edit />
                        <div class="btn-div">
                            <label class="form-label">12) Իրադարձությանն առնչություն ունեցող զենք</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'weapon', 'relation' => 'weapon']) }}">Ավելացնել</a>
                        </div>

                        <x-tegs name="id" :data="$event" relation="action" :label="__('content.short_action') . ': '" edit />
                        <div class="btn-div">
                            <label class="form-label">13) Իրադարձությանն առնչություն ունեցող գործողություն</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'action', 'relation' => 'action']) }}">Ավելացնել</a>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">14) Հարուցվել է քրեական գործ</label>
                            <a href="/btn8">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn8"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">15) Ստուգվում է որպես ահազանգ</label>
                            <a href="/btn9">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn9"></div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="resource" placeholder="" value="{{ $event->resource->name ?? null }}"
                                    data-modelid="{{ $event->resource->id ?? null }}" name="resource_id" tabindex="16"
                                    data-type="update_field" list="resource-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='resource' data-fieldname='name'></i>
                                <label for="item6" class="form-label">16) Տեղեկատվության աղբյուր</label>
                            </div>
                            <datalist id="resource-list" class="input_datalists" style="width: 500px;"> </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">17) Տվյալ իրադարձությունը կապված է գործողության հետ</label>
                            <a href="/btn10">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn10"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">18) Փաստաթղթի բովանդակութըունը</label>
                            <div class="file-upload-content tegs-div">
                                <x-tegs name="name" :data="$event->bibliography" relation="files"  />

                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">19) Կապեր</label>
                            <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police">
                                <x-teg :name="'id'" :item="$event" inputName="bibliography" :label="__('content.short_bibl')"/>
                            </div>
                        </div>
                        <!-- Vertical Form -->
                    </div>
                </div>
    </section>

    <x-scroll-up />
    <x-fullscreen-modal />
    <x-errorModal />



@section('js-scripts')
    <script>
        let parent_id = "{{ $event->id }}"
        let lang = "{{ app()->getLocale() }}"
        let open_modal_url = "{{ route('open.modal') }}"
        let get_filter_in_modal = "{{ route('get-model-filter') }}"
        let updated_route = "{{ route('event.update', $event->id) }}"
        let file_updated_route = "{{ route('updateFile', $event->id) }}"
        let delete_item = "{{ route('delete_tag') }}"
        let result_search_dont_matched = `{{ __('validation.result_search_dont_matched') }}`
    </script>
    <script src='{{ asset('assets/js/script.js') }}'></script>
    <script src="{{ asset('assets/js/tag.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.1/mammoth.browser.min.js"></script>
    <script src="{{ asset('assets/js/error_modal.js') }}"></script>
    <script src='{{ asset('assets/js/event/script.js') }}'></script>
@endsection
@endsection
