@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/phone/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection

@section('content')
    <x-breadcrumbs :title="__('content.phone_number')" />

    <!-- End Page Title -->
    <section class="section">
        <div class="card">
            <div class="card-body">
                <x-form-error/>
                <!-- Vertical Form -->
                <form class="form" method="POST"

                      action="{{isset($edit) ? route('phone.update',[$phone->id,'model' => $modelData->name ?? null,'id'=>$modelData->id ?? null]) :  route('phone.store', ['model' => $modelData->name,'id'=>$modelData->id])}}">
                       @if(isset($edit))
                           @method('PUT')
                       @endif
                    @csrf

{{--                           {{dd($modelData)}}--}}
                    <x-back-previous-url submit/>
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputDate2"
                                    placeholder=""
                                    value="{{$modelData->model->number ?? null}}"
                                    name="number"
                                    tabindex="1"
                                />
                                <label for="inputDate2" class="form-label"
                                >1) {{__('content.telephone_number')}}</label>
                            </div>
                        </div>
                     @if(isset($modelData->name) && $modelData->name !== 'action' && isset($showRelation))
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="character_id"
                                    @if(isset($edit))
                                    value="{{$modelData->model->character[0]->id ?? null}}"
                                    @endif
                                    >
                                <input
                                    type="text"
                                    class="form-control get_datalist set_value"
                                    id="character"
                                    placeholder=""
                                    data-id=""
                                    @if(isset($edit))
                                    value="{{$modelData->model->character[0]->name ?? null}}"
                                    @endif
                                    tabindex="2"
                                    data-model="character"
                                    data-fieldname="name"
                                    list="character-list"/>
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='character'
                                    data-fieldname='name'
                                ></i>
                                <label for="character" class="form-label"
                                >2) {{__('content.nature_character')}}</label
                                >
                            </div>
                            <datalist id="character-list" class="input_datalists" style="width: 500px;">
                            </datalist>
                        </div>
                        @endif
                        <div class="col">
                            <div class="form-floating">
                    <textarea
                        type="text"
                        class="form-control"
                        id="inputDate2"
                        placeholder=""
                        name="more_data"
                        tabindex="3"> @if(isset($edit)){{$modelData->model->more_data}}@endif
                        </textarea>
                                <label for="inputDate2" class="form-label"
                                >3) {{__('content.additional_data')}}</label
                                >
                            </div>
                        </div>
                        @if(Route::currentRouteName() === 'edit.show')
                            <div class="col">
                                <label for="inputDate2" class="form-label"
                                >4) {{__('content.ties')}}</label>
                            </div>
                        @endif

                            <x-tegs name="id" :data="$modelData->model" relation="all_relation" :label="__('content.short_phone')"
                                tableName="phone" related />


                    </div>
                </form>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>
    @section('js-scripts')
        @if(isset($modelData->name))
            <script>
                let parent_id = "{{$modelData->id}}"
            </script>
        @endif

        {{--        <script src="{{ asset('assets/js/phone/script.js') }}"></script>--}}
        <script src="{{ asset('assets/js/script.js') }}"></script>
    @endsection
@endsection

