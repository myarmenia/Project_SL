@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/man/style.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/organization/organization.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/calendar.css') }}">

@endsection


@section('content')

    <!-- End Page Title -->
    <section class="section">
        <div class="card">
            <div class="card-body">
                <x-form-error/>
                <!-- Vertical Form -->
                    <form class="form" method="POST"
                          action="{{ Route::currentRouteName() !== 'work.create' ?
                                route('work.update',[$modelData->model->id,'model' => $modelData->name ?? null,'id'=>$modelData->id ?? null,'redirect'=>$modelData->redirect]) :
                                route('work.store', ['model' => $modelData->name,'id'=>$modelData->id,'redirect'=>$modelData->redirect])}}">
                        @if( Route::currentRouteName() !== 'work.create')
                            @method('PUT')
                        @endif

                    <x-back-previous-url submit/>

                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    @if(!$teg) disabled @endif
                                    type="text"
                                    class="form-control save_input_data fetch_input_title"
                                    id="inputDate2"
                                    placeholder=""
                                    name="title"
                                    value="{{$modelData->model->title}}"
                                />
                                <label for="inputDate2" class="form-label"
                                >1) {{__('content.position')}}</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    @if(!$teg) disabled @endif
                                    type="text"
                                    class="form-control"
                                    id="inputDate2"
                                    placeholder=""
                                    name="period"
                                    value="{{$modelData->model->period}}"
                                />
                                <label for="inputDate2" class="form-label"
                                >2) {{__('content.data_refer_period')}}</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper calendar-container">
                                <input
                                    @if(!$teg) disabled @endif
                                    type="text"
                                    placeholder=""
                                    id="inputDate1"
                                    class="form-control calendarInput"
                                    name="start_date"
                                    value="{{$modelData->model->start_date}}"
                                    data-check="date"
                                    autocomplete="off" onblur="handleBlur(this)"
                                />
                                <span class="calendar-icon " onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>

                                <label for="inputDate1" class="form-label"
                                >3) {{__('content.start_employment')}}</label
                                >
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating input-date-wrapper calendar-container">
                                <input
                                    @if(!$teg) disabled @endif
                                    type="text"
                                    placeholder=""
                                    id="inputDate1"
                                    class="form-control calendarInput"
                                    name="end_date"
                                    value="{{$modelData->model->end_date}}"
                                    data-check="date"
                                    autocomplete="off" onblur="handleBlur(this)"
                                />
                                <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>

                                <label for="inputDate1" class="form-label"
                                >4) {{__('content.end_employment')}}</label>
                            </div>
                        </div>
                        <div class="btn-div">
                            @if($modelData->name === 'man')
                                <label class="form-label">5) {{__('content.jobs_organization')}}</label>
                                @if(Route::currentRouteName() === 'work.create' && !$teg )
                                    <a href="{{ route('open.page', ['page' => 'organization', 'route_name' => $modelData->name, 'main_route' => 'work.create', 'model_id' => $modelData->id, 'redirect'=>$modelData->redirect]) }}">{{ __('content.addTo') }}</a>
                                    <x-teg :item="$teg" :label="__('content.short_organ')" :inputName="$modelData->name === 'man' ? 'organization_id' : 'man_id'" name="id" :redirect="['route'=>'work.create', 'model' => $modelData->name, 'id'=>$modelData->id, 'redirect'=> $modelData->redirect]" delete/>
                                @elseif(Route::currentRouteName() !== 'work.edit')
                                     <x-teg :item="$teg" :label="__('content.short_organ')" :inputName="$modelData->name === 'man' ? 'organization_id' : 'man_id'" name="id" :redirect="['route'=>'work.create', 'model' => $modelData->name, 'id'=>$modelData->id, 'redirect'=> $modelData->redirect]" delete/>
                                @endif
                            @else
                                <label class="form-label">5) {{__('content.data_employment_persons')}}</label>
                                @if(Route::currentRouteName() === 'work.create' && !$teg )
                                  <a href="{{ route('open.page', ['page' => 'man', 'route_name' => $modelData->name, 'main_route' => 'work.create', 'model_id' => $modelData->id, 'redirect'=>$modelData->redirect]) }}">{{ __('content.addTo') }}</a>
                                    <x-teg :item="$teg" inputName="man_id" name="id" :label="__('content.short_man')"  :redirect="['route'=>'work.create', 'model' => $modelData->name, 'id'=>$modelData->id, 'redirect'=> $modelData->redirect]" />
                                @else
                                    @if($modelData->name)
                                        <x-teg :item="$teg" inputName="man_id" name="id" :label="__('content.short_man')"  :redirect="['route'=>'work.create', 'model' => $modelData->name, 'id'=>$modelData->id, 'redirect'=> $modelData->redirect]" delete/>
                                    @else
                                        <x-teg :item="$teg" inputName="man_id" name="id" :label="__('content.short_man')"  :redirect="['route'=>'work.create', 'model' => $modelData->name, 'id'=>$modelData->id, 'redirect'=> $modelData->redirect]" />
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>

                    @if(Route::currentRouteName() !== 'work.create')
                        <div class="col flex justify-content-between">
                            <label for="inputDate2" class="form-label"
                            >6) {{__('content.ties')}}</label>
                            <x-tegs-relations :model="$modelData->model"/>
                        </div>
                    @endif
                </form>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>

    @section('js-scripts')
        <script>
            let parent_id = "{{$modelData->id}}"
        </script>
        <script src="{{ asset('assets/js/saveFields.js') }}"></script>
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src='{{ asset('assets/js/main/date.js') }}'></script>

    @endsection
@endsection

