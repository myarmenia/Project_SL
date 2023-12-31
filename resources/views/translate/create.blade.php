@extends('layouts.auth-app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/translate/index.css') }}">
@endsection

@section('content')




    <!-- End Page Title -->



    <section class="section">

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <x-back-previous-url />
                    <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <div class="add-translate-block">

                        <div class="translate-input-block">
                            <input type="text" name="content" placeholder="{{ __('content.content_translate') }}" class="form-control create-translate-inp">
                        </div>

                        <div class="translate-select-block">

                            <select name="chapter" id="" class="form-select create-translate-select">
                                <option value="" hidden>{{ __('content.select_type') }}</option>
                                @foreach ($chapters as $chapter)
                                    <option data-id = "{{ $chapter->id }}" value="{{ $chapter->id }}">{{ $chapter->content}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary translate-send-btn">{{ __('content.translation') }}</button>

                    </div>


                </div>
            </div>
        </div>
    </section>


@section('js-scripts')
<script>
    let confirm_translate = '{{ __('content.confirm_translate') }}'
    let existent_translate = '{{ __('content.existent_translate') }}'
    let lang_am = '{{__('content.lang_am')}}'
    let lang_ru = '{{__('content.lang_ru')}}'
    let lang_eng = '{{__('content.lang_eng')}}'
    let type = '{{__('content.type')}}'
    let confirm = '{{ __('content.confirm') }}'
</script>
    <script src='{{ asset('assets/js/translate/translate.js') }}'></script>
@endsection

@endsection
