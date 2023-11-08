@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/event/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Կապն օբյեկտների միջև</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <x-form-error/>
                <!-- Vertical Form -->
                <form class="form" method="POST" action="{{route( Route::currentRouteName() === 'operational-interest.create' ? 'operational-interest.store' : 'operational-interest-organization-man.store', $man->id)}}">
                    @csrf
                    <button type="submit" class="submit-btn"><i class="bi bi-arrow-left"></i></button>
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="relation_type_id"
                                    value="">
                                <input
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
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='relation_type'
                                    data-fieldname='name'>
                                </i>
                                <label for="relation_type" class="form-label"
                                >1) Կապի բնույթը</label
                                >
                            </div>
                            <datalist id="relation-type-list" class="input_datalists" style="width: 500px;">
                            </datalist>
                        </div>
                        <x-teg :item="$teg" inputName="second_object_id" name="id" label=""/>
                        <div class="btn-div">
                            <label class="form-label">2) Կոնկրետ կապ</label>
                            <a href="{{ route('open.page', Route::currentRouteName() === 'operational-interest.create' ? 'man' : 'organization') }}">
                                <span>{{ __('table.add') }}</span>
                            </a>
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
            document.querySelector('.delete-from-db')?.addEventListener('click',function(){
                this.closest('.tegs-div').remove()
                sessionStorage.removeItem('modelId');
            })

            let parent_id = "<?php echo e($man->id); ?>"
            let get_filter_in_modal = `<?php echo e(route('get-model-filter')); ?>`
            let open_modal_url = "<?php echo e(route('open.modal')); ?>"
            let lang = "{{ app()->getLocale() }}"
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
