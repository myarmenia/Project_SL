@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/translate/index.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1> {{ __('content.edit') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('content.translation') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('content.edit') }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->



    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <x-back-previous-url />
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="translate-select-block ">
                        <select name="chapter" id="" class="form-select edit-translate">
                            {{-- <option value="" hidden>{{ __('content.select_type') }}</option> --}}
                            @foreach ($chapters as $chapter)
                                <option data-id = "{{ $chapter->id }}" value="{{ $chapter->id }}">{{ $chapter->content }}
                                </option>
                            @endforeach
                            {{-- <option value="1">Anun</option>
                            <option value="2">Azganun</option>
                            <option value="3">Hayranun</option> --}}
                        </select>
                    </div>
                    <div class="edit-input-block">
                        <div class="edit-input">
                            <label for="">{{ __('content.lang_am') }}</label>
                            <input type="text" class="form-control edit-change-input"
                                value="{{ $learning_system->armenian }}">
                        </div>

                        <div class="edit-input">
                            <label for=""> {{ __('content.lang_ru') }}</label>
                            <input type="text" class="form-control  edit-change-input"
                                value="{{ $learning_system->russian }}">
                        </div>
                        <div class="edit-input">
                            <label for="">{{ __('content.lang_eng') }}</label>
                            <input type="text" class="form-control  edit-change-input"
                                value="{{ $learning_system->english }}">
                        </div>

                        <div class="edit-button">
                            <button class="btn btn-primary edit-send-btn"
                                onclick="editConfirm()">{{ __('content.confirm_translate') }}</button>
                        </div>
                    </div>

                    <div class="show-child-block">
                        <ul>
                            @foreach ($learning_system_option as $l_o)
                                <li class="child-li">{{ $l_o->name }}</li>
                                {{-- <li class="child-li">Anka</li>
                                <li class="child-li">Anush</li>
                                <li class="child-li">Annman</li> --}}
                            @endforeach

                        </ul>
                        <input type="text" class="form-control" data-id="1"
                            placeholder="{{ __('content.add_version') }}" onblur="editInputBlur(this)">
                    </div>


                </div>
            </div>
        </div>
    </section>


@section('js-scripts')
    <script>
        let confirm_translate = '{{ __('content.confirm_translate') }}'
        let existent_translate = '{{ __('content.existent_translate') }}'
        let armenian_translate = '{{ __('content.armenian_translate') }}'
    </script>
    <script src='{{ asset('assets/js/translate/translate.js') }}'></script>
@endsection
@endsection
