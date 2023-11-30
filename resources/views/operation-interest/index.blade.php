@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/event/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection


@section('content')

    <x-breadcrumbs :title="__('content.relationship_objects')" />

    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <x-form-error/>
                <!-- Vertical Form -->
                <form class="form" method="POST" action="{{route('operational-interest.create', ['model' => $modelData->name,'id'=>$modelData->id, 'redirect'=>$redirect])}}">
                    @csrf
                    <button type="submit" class="submit-btn"><i class="bi bi-arrow-left"></i></button>
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    @if(!$teg) disabled @endif
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="relation_type_id"
                                    value="">
                                <input
                                    @if(!$teg) disabled @endif
                                    type="text"
                                    class="form-control get_datalist set_value"
                                    id="relation_type"
                                    placeholder=""
                                    data-id=""
                                    tabindex="2"
                                    data-model="relation_type"
                                    data-fieldname="name"
                                    list="relation-type-list"/>
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class @if(!$teg) my-plus-disable @endif"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='relation_type'
                                    data-fieldname='name'>
                                </i>
                                <label for="relation_type" class="form-label"
                                >1) {{__('content.character_link')}}</label
                                >
                            </div>
                            <datalist id="relation-type-list" class="input_datalists" style="width: 500px;">
                            </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">2) {{__('content.specific_link')}}</label>
                            <a href="{{ route('open.page', ['page' => $modelData->name, 'route_name' => $modelData->name, 'main_route' => 'operational-interest.create', 'model_id' => $modelData->id, 'redirect'=>$redirect]) }}">{{ __('content.addTo') }}</a>
                            <x-teg :item="$teg" inputName="second_object_id" name="id" label="" :redirect="['route'=>'operational-interest.create', 'model' => $modelData->name,'id'=>$modelData->id,'redirect'=>$redirect]" delete/>
                        </div>
                    </div>
                    <!-- ######################################################## -->
                    <!-- Submit button -->
                    <!-- ######################################################## -->
                </form>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>


    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>
    @php
        session(['modelId' => null]);
    @endphp
    @section('js-scripts')
        <script>
            let parent_id = "<?php echo e($modelData->id); ?>"
            let ties = "{{__('content.ties')}}"
            let parent_table_name = "{{__('content.organization')}}"

            let fieldName = 'organization_id'
            let session_main_route = "{{ Session::has('main_route') }}"

        </script>
{{--        <!-- <script src="{{ asset('assets/js/event/script.js') }}"></script> -->--}}
        <script src="{{ asset('assets/js/script.js') }}"></script>
{{--        <script src="{{ asset('assets/js/tag.js') }}"></script>--}}
    @endsection
@endsection
