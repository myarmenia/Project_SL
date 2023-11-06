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

                            <x-tegs :data="$event" :relation="'event_qualification'" :name="'name'" />

                            <div class="form-floating">

                                <input style='outline:3px solid red;' type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="event_qualification"
                                    name="qualification_id"
                                    tabindex="1"
                                    list="event_qualification-list"
                                    data-type="attach_relation"
                                    data-table="event_qualification"
                                    data-model="EventQualification"
                                    data-fieldname='name'
                                    data-parent-model-name='Event'
                                    data-pivot-table='event_qualification'
                                />

                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-table-name='event_qualification'
                                    data-fieldname='name'></i>
                                <label for="event_qualification" class="form-label">
                                    1) {{__('content.qualification_event')}}</label>
                            </div>
                            <datalist id="event_qualification-list" class="input_datalists" style="width: 500px;"> </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">

                                <input
                                    type="date"
                                    placeholder=""
                                    value="{{ $event->date ? date('Y-m-d', strtotime($event->date)) : null }}"
                                    id="item2"
                                    tabindex="2"
                                    data-type="update_field"
                                    class="form-control save_input_data"
                                    name="date"
                                />
                                <label for="item2" class="form-label">2) Իրադարձության ամսաթիվ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">

                                <input
                                    id="item3"
                                    type="time"
                                    placeholder=""
                                    value="{{ $event->date && date('H:i', strtotime($event->date)) != '00:00' ? date('H:i', strtotime($event->date)) : null }}"
                                    tabindex="3"
                                    data-type="update_field"
                                    class="form-control save_input_data"
                                    name="time"
                                />
                                <label for="item3" class="form-label">3) Իրադարձության ժամ</label>
                            </div>
                        </div>

                        {{-- <x-teg :name="'name'" :item="$address" inputName="address_id"/> --}}
                        <div class="btn-div">
                            <label class="form-label">4) Իրադարձության վայր հասցե</label>
                            {{-- <a href="{{ route('open.page_redirect', ['route' => 'address','redirect_route'=>request()->route()->getName(), 'id'=>$event->id]) }}">Ավելացնել</a> --}}
                            <a href="{{ route('open.page_redirect', ['route' => 'address','redirect_route'=>request()->route()->getName(), 'id'=>$event->id]) }}">Ավելացնել</a>

                            <div class="tegs-div" name="tegsDiv2" id="//btn1"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">5) Միջոցառման անցկացման վայրը(կազմակերպություն)</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn2"></div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title" id="item4" placeholder=""
                                    data-id="4" name="access_level_id" list="brow2" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url = '{{ route('get-model-filter', ['path' => 'access_level']) }}'
                                    data-section = 'get-model-name-in-modal' data-id = 'access_level'></i>
                                <label for="item4" class="form-label">6) Իրադարձության (հնարավոր) հետևանքները</label>
                            </div>
                            <datalist id="brow2" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title" id="item5"
                                    placeholder="" data-id="5" name="access_level_id" list="brow3" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url = '{{ route('get-model-filter', ['path' => 'access_level']) }}'
                                    data-section = 'get-model-name-in-modal' data-id = 'access_level'></i>
                                <label for="item5" class="form-label">7) Հետաքննությունը հանձնարարված է</label>
                            </div>
                            <datalist id="brow3" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item6" placeholder=""
                                    name="short_desc" />
                                <label for="item6" class="form-label">8) Իրադարձության հետաքննության
                                    արդյունքները</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">9) Իրադարձությանն առնչություն ունեցող անձինք</label>
                            <a href="/btn3">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn3"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">10) Իրադարձությանն առնչություն ունեցող կազմակերպություն</label>
                            <a href="/btn4">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn4"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">11) Իրադարձությանն առնչություն ունեցող ավտոմեքենա</label>
                            <a href="/btn5">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn5"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">12) Իրադարձությանն առնչություն ունեցող զենք</label>
                            <a href="/btn6">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn6"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">13) Իրադարձությանն առնչություն ունեցող գործողություն</label>
                            <a href="/btn7">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn7"></div>
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
                                <input type="text" class="form-control fetch_input_title" id="item6"
                                    placeholder="" data-id="6" name="access_level_id" list="brow4" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url = '{{ route('get-model-filter', ['path' => 'access_level']) }}'
                                    data-section = 'get-model-name-in-modal' data-id = 'access_level'></i>
                                <label for="item6" class="form-label">16) Տեղեկատվության աղբյուր</label>
                            </div>
                            <datalist id="brow4" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">17) Տվյալ իրադարձությունը կապված է գործողության հետ</label>
                            <a href="/btn10">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn10"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">18) Փաստաթղթի բովանդակութըունը</label>
                            <div class="file-upload-content tegs-div">
                                <div class="Myteg">
                                    <span><a href="">dddd</a></span>
                                </div>
                                <div class="Myteg">
                                    <span><a href="">ffff</a></span>
                                </div>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">19) Կապեր</label>
                            <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police"></div>
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
