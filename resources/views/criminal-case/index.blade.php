@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/criminalCase/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Քրեական գործ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item">{{ __('content.criminal_case') }}</li>
                    <li class="breadcrumb-item active">ID: {{ $criminal_case->id }}</li>
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

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" id="number" placeholder=""
                                    value="{{ $criminal_case->number ?? null }}" name="number" tabindex="1"
                                    data-type="update_field" />
                                <label for="number" class="form-label">1) Գործի համար</label>
                            </div>
                        </div>

                        <x-tegs :name="'id'" :data="$criminal_case" :relation="'man'" :label="__('content.short_man') . ': '" edit delete />
                        <div class="btn-div">
                            <label class="form-label">2) Գործը վերաբերում է անձին</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'man', 'relation' => 'man']) }}">Ավելացնել</a>
                        </div>

                        <x-tegs :name="'id'" :data="$criminal_case" :relation="'organizations'" :label="__('content.short_organ') . ': '" edit delete />
                        <div class="btn-div">
                            <label class="form-label">3) Գործը վերաբերում է Կազմակերպությանը</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'organization', 'relation' => 'organizations']) }}">Ավելացնել</a>
                        </div>



                        <div class="col">
                            <div class="form-floating input-date-wrapper">

                                <input type="date" placeholder="" value="{{ $criminal_case->opened_date ?? null }}"
                                    id="opened_date" tabindex="2" data-type="update_field"
                                    class="form-control save_input_data" name="opened_date" />
                                <label for="opened_date" class="form-label">4) Քրեական գործի հարուցում (ամսաթիվ)</label>

                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" placeholder="" value="{{ $criminal_case->artical ?? null }}"
                                    id="artical" tabindex="3" data-type="update_field"
                                    class="form-control save_input_data" name="artical" />
                                <label for="artical" class="form-label">5) Քրեական գործի հարուցում Քր․ օր․ հոդված</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="agency" value="{{ $criminal_case->opened_agency->name ?? null }}"
                                    data-modelid="{{ $criminal_case->opened_agency->id ?? null }}" name="opened_agency_id"
                                    tabindex="6" data-type="update_field" list="agency-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='agency' data-fieldname='name'></i>
                                <label for="agency" class="form-label">6) Հարուցվել է վարչության նյութերով</label>
                            </div>
                            <datalist id="agency-list" class="input_datalists" style="width: 500px;"> </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="opened_unit_agency" value="{{ $criminal_case->opened_unit_agency->name ?? null }}"
                                    data-modelid="{{ $criminal_case->opened_unit_agency->id ?? null }}"
                                    name="opened_unit_id" tabindex="7" data-type="update_field"
                                    list="opened_unit_agency-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='agency' data-fieldname='name'></i>
                                <label for="opened_unit_agency" class="form-label">7) Հարուցվել է բաժնի նյութերով</label>
                            </div>
                            <datalist id="opened_unit_agency-list" class="input_datalists" style="width: 500px;">
                            </datalist>

                        </div>

                        <div class="col">

                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="subunit_id" value="{{ $criminal_case->subunit_agency->name ?? null }}"
                                    data-modelid="{{ $criminal_case->subunit_agency->id ?? null }}" name="subunit_id"
                                    tabindex="8" data-type="update_field" list="subunit_id-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='agency' data-fieldname='name'></i>
                                <label for="subunit_id" class="form-label">8) Հարուցվել է ստորաբաժանման նյութերով</label>
                            </div>
                            <datalist id="subunit_id-list" class="input_datalists" style="width: 500px;"> </datalist>

                        </div>

                        <div class="col">
                            <x-tegs :data="$criminal_case" relation="worker" name="worker" delete/>
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control my-form-control-class my-teg-class save_input_data"
                                    id="worker" name="worker" tabindex="9"
                                     data-type="create_relation"
                                    data-table="criminal_case_worker" data-model="Worker" data-fieldname='worker'
                                    data-parent-model-name='CriminalCase' data-pivot-table='criminal_case_worker' />

                                <label for="worker" class="form-label">
                                    9) Օ/ա Ա․Հ․Ազգանունը</label>
                            </div>
                        </div>

                        <div class="col">
                            <x-tegs :data="$criminal_case" :relation="'worker_post'" name="name" delete/>
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="worker_post" name="qualification_id" tabindex="10"
                                    list="worker_post-list" data-type="attach_relation"
                                    data-table="worker_post" data-model="WorkerPost" data-fieldname='name'
                                    data-parent-model-name='Event' data-pivot-table='worker_post' />

                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-table-name='worker_post'

                                    data-fieldname='name'></i>
                                <label for="worker_post" class="form-label">
                                    10) Օ/ա պաշտոնը</label>
                            </div>
                            <datalist id="worker_post-list" class="input_datalists" style="width: 500px;"> </datalist>
                        </div>


                        <div class="col">
                            <div class="form-floating">
                                <input type="text" placeholder="" value="{{ $criminal_case->character ?? null }}"
                                    id="character" tabindex="11" data-type="update_field"
                                    class="form-control save_input_data" name="character" />
                                <label for="character" class="form-label">11) Նյութերի բնույթը (երանգավորում)</label>
                            </div>
                        </div>

                        <x-tegs :name="'id'" :data="$criminal_case" :relation="'action'" :label="__('content.short_action') . ': '" edit delete />
                        <div class="btn-div">
                            <label class="form-label">12) Հարուցվել է փաստով (գործողություն)</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'action', 'relation' => 'action']) }}">Ավելացնել</a>
                        </div>

                        <x-tegs :name="'id'" :data="$criminal_case" :relation="'event'" :label="__('content.short_event') . ': '" edit delete />
                        <div class="btn-div">
                            <label class="form-label">13) Հարուցվել է փաստով (իրադարձություն)</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'event', 'relation' => 'event']) }}">Ավելացնել</a>
                        </div>

                        <x-tegs :name="'id'" :data="$criminal_case" :relation="'signal'" :label="__('content.short_signal') . ': '" edit delete />
                        <div class="btn-div">
                            <label class="form-label">14) Հարուցվել է ահազանգի ստուգման արդյունքները</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'signal', 'relation' => 'signal']) }}">Ավելացնել</a>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" placeholder="" value="{{ $criminal_case->opened_dou ?? null }}"
                                    id="opened_dou" tabindex="15" data-type="update_field"
                                    class="form-control save_input_data" name="opened_dou" />
                                <label for="opened_dou" class="form-label">15) Հարուցվել է ՕՀԳ հիման վրա</label>
                            </div>
                        </div>


                        <x-tegs :name="'id'" :data="$criminal_case" :relation="'criminal_case'" :label="__('content.short_criminal_casel') . ': '" edit delete />
                        <div class="btn-div">
                            <label class="form-label">16) Կազմվել է քրեական գործերից</label>
                            <a
                                href="{{ route('page_redirect', ['table_route' => 'criminal_case', 'relation' => 'criminal_case']) }}">Ավելացնել</a>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">17) Անջատել քրեական գործերից</label>
                            <a href="//btn7">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="//btn7"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">24) Փաստաթղթի բովանդակութըունը</label>
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
                            <label class="form-label">25) Կապեր</label>
                            <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police"></div>
                        </div>

                    </div>
                </form>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>

    <x-scroll-up />
    <x-fullscreen-modal />
    <x-errorModal />

@section('js-scripts')
    <script>
        let parent_id = "{{ $criminal_case->id }}"
        let lang = "{{ app()->getLocale() }}"
        let open_modal_url = "{{ route('open.modal') }}"
        let get_filter_in_modal = "{{ route('get-model-filter') }}"
        let updated_route = "{{ route('criminal_case.update', $criminal_case->id) }}"
        let delete_item = "{{ route('delete_tag') }}"
        let result_search_dont_matched = `{{ __('validation.result_search_dont_matched') }}`
    </script>
    <script src='{{ asset('assets/js/script.js') }}'></script>
    <script src="{{ asset('assets/js/tag.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.1/mammoth.browser.min.js"></script>
    <script src="{{ asset('assets/js/error_modal.js') }}"></script>
    <script src='{{ asset('assets/js/criminalCase/script.js') }}'></script>
@endsection
@endsection
