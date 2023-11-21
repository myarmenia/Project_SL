@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/action/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection

@section('content')
    <x-breadcrumbs :title="__('sidebar.action')" :crumbs="[['name' => __('sidebar.action'), 'route' => 'open.page', 'route_param' => 'action', 'parent'=>['name' => __('content.bibliography'), 'route'=>'bibliography.edit', 'id' => $action->bibliography_id]]]" :id="$action->id"/>
    <!-- End Page Title -->
    <section class="section">
        <div class="card">
            <div class="card-body">

                <!-- Vertical Form -->
                <div class="form">
                    <div class="inputs row g-3">

                        <div class="btn-div">
                            <label class="form-label">1) Գործողության բովանդակաություն</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" id="//btn"></div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="action_qualification_id"
                                    placeholder=""
                                    name="action_qualification_id"
                                    value="{{$action->qualification_column?->name}}"
                                    tabindex="1"
                                    data-type="update_field"
                                    data-fieldname="name"
                                    list="action_qualification_list"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='action_qualification'
                                    data-fieldname='name'
                                ></i>
                                <label for="action_qualification_id" class="form-label"
                                >2) Գործողության որակավորում</label>
                            </div>
                            <datalist id="action_qualification_list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" placeholder=""
                                       value="{{$action->start_date ? date('Y-m-d', strtotime($action->start_date)) : null }}"
                                       id="start_date" tabindex="2" data-type="update_field"
                                       class="form-control save_input_data" name="start_date" />
                                <label for="start_date" class="form-label"> 3) Գործողության սկիզբ (ամսաթիվ)</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input id="start_date_time" type="time" placeholder=""
                                       value="{{$action->start_date && date('H:i', strtotime($action->start_date)) != '00:00' ? date('H:i', strtotime($action->start_date)) : null }}"
                                       tabindex="3" data-type="update_field" class="form-control save_input_data"
                                       name="start_time" />
                                <label for="start_date_time" class="form-label">4) Գործողության ավարտ (ժամ)</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" placeholder=""
                                       value="{{$action->end_date ? date('Y-m-d', strtotime($action->end_date)) : null }}"
                                       id="end_date" tabindex="4" data-type="update_field"
                                       class="form-control save_input_data" name="start_date" />
                                <label for="start_date" class="form-label"> 5) Գործողության ավարտ (ամսաթիվ)</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input id="start_date_time" type="time" placeholder=""
                                       value="{{$action->end_date && date('H:i', strtotime($action->end_date)) != '00:00' ? date('H:i', strtotime($action->end_date)) : null }}"
                                       tabindex="5" data-type="update_field" class="form-control save_input_data"
                                       name="end_time" />
                                <label for="start_date_time" class="form-label">6) Գործողության ավարտ (ժամ)</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="action_duration_id"
                                    placeholder=""
                                    name="duration_id"
                                    value="{{$action->duration?->name}}"
                                    tabindex="1"
                                    data-type="update_field"
                                    data-fieldname="name"
                                    list="action_duration_list"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='duration'
                                    data-fieldname='name'
                                ></i>
                                <label for="action_duration_id" class="form-label"
                                >7) Գործողության տևողությունը</label>
                            </div>
                            <datalist id="action_duration_list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="acton_goal_id"
                                    placeholder=""
                                    name="goal_id"
                                    value="{{$action->goal?->name}}"
                                    tabindex="1"
                                    data-type="update_field"
                                    data-fieldname="name"
                                    list="action_goal_list"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='action_goal'
                                    data-fieldname='name'
                                ></i>
                                <label for="acton_goal_id" class="form-label"
                                >8) Նպատակը, դրդապատճառը, պատճառը</label>
                            </div>
                            <datalist id="action_goal_list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="acton_terms_id"
                                    placeholder=""
                                    name="terms_id"
                                    value="{{$action->terms?->name}}"
                                    tabindex="1"
                                    data-type="update_field"
                                    data-fieldname="name"
                                    list="action_terms_list"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='terms'
                                    data-fieldname='name'
                                ></i>
                                <label for="acton_terms_id" class="form-label"
                                >9) Գործողության կատարման պայմանները</label>
                            </div>
                            <datalist id="action_termslist" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>


                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="acton_aftermath_id"
                                    placeholder=""
                                    name="aftermath_id"
                                    value="{{$action->aftermath?->name}}"
                                    tabindex="1"
                                    data-type="update_field"
                                    data-fieldname="name"
                                    list="action_aftermath_list"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='aftermath'
                                    data-fieldname='name'
                                ></i>
                                <label for="acton_aftermath_id" class="form-label"
                                >10) Իրադարձության (հնարավոր) հետևանքները</label>
                            </div>
                            <datalist id="action_aftermath_list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">11) Գործողությունը կապված է գործողության հետ</label>
                            <a href="{{ route('open.page', ['page' =>'action', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'action']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$action" relation="action" name="id" :label="__('content.short_action')" delete/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">12) Գործողությունը կապված է իրադարձության հետ</label>
                            <a href="{{ route('open.page', ['page' =>'event', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'event']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$action" relation="event" name="id" delete/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">13) Գործողության օբյեկտ (անձ)</label>
                            <a href="{{ route('open.page', ['page' =>'man', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'man']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$action" relation="man" name="id" delete/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">14) Գործողության օբյեկտ (Իրադարձություն)</label>
                            <a href="{{ route('open.page', ['page' =>'man', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'man']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$action" relation="man" name="id" delete/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">15) Գործողության օբյեկտ (կազմակերպություն)</label>
                            <a href="{{ route('open.page', ['page' =>'organization', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'organization']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$action" relation="organization" name="id" delete/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">16) Գործողության օբյեկտ (հեռախոս)</label>
                            <a href="{{route('phone.create',['model' => 'action','id'=>$action->id ])}}">{{__('content.addTo')}}</a>
                            <x-tegs :data="$action" relation="phone" name="number" label="ՀԵՌ ։ " delete/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">17) Գործողության օբյեկտ (զենք)</label>
                            <a href="{{ route('open.page', ['page' =>'weapon', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'weapon']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$action" relation="weapon" name="id" delete/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">17) Գործողության օբյեկտ (ավտոմեքենա)</label>
                            <a href="{{ route('open.page', ['page' =>'car', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'car']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$action" relation="car" name="id" delete/>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control save_input_data"
                                    id="source_id"
                                    placeholder=""
                                    value="{{$action->source}}"
                                    name="source"
                                    tabindex="16"
                                    data-type="update_field"
                                />
                                <label for="source_id" class="form-label">19) Տեղեկատվության աղբյուր</label>
                            </div>
                        </div>


                        <div class="btn-div">
                            <label class="form-label">20) Ստուգվում է որպես ահազանգ</label>
                            <a href="{{ route('open.page', ['page' =>'signal', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'signal']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$action" relation="signal" name="id" delete/>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control save_input_data"
                                    id="opened_dou_id"
                                    placeholder=""
                                    value="{{$action->opened_dou}}"
                                    name="opened_dou"
                                    tabindex="16"
                                    data-type="update_field"
                                />
                                <label for="opened_dou_id" class="form-label">21) Բացվել է ՕՀԳ</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">22) Հարուցվել է քրեական գործ</label>
                            <a href="{{ route('open.page', ['page' =>'criminal_case', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'criminal_case']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$action" relation="criminal_case" name="id" delete/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">23) Գործողության անցկացման վայրը</label>
                            <a href="{{ route('open.page', ['page' =>'address', 'main_route' => 'action.edit', 'model_id' => $action->id, 'relation' => 'address']) }}">{{ __('content.addTo') }}</a>
                            <x-teg :item="$action->address" inputName="address_id" :label="__('content.short_address')" edit delete/>
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
                            <x-teg :item="$action->bibliography" inputName="" :label="__('content.bibliography')" edit delete/>
                        </div>
                        <!-- Vertical Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>

    @section('js-scripts')
        <script>
            let parent_id = "{{ $action->id }}"
            let updated_route = "{{route('action.update',$action->id)}}"
            let delete_item = "{{route('delete_tag')}}"
        </script>
        <script src='{{ asset('assets/js/script.js') }}'></script>
        <script src="{{ asset('assets/js/tag.js') }}"></script>
        <script src="{{ asset('assets/js/error_modal.js') }}"></script>
        <script src='{{ asset('assets/js/action/script.js') }}'></script>
    @endsection
@endsection