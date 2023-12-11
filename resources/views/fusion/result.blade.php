@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/fusion/result.css') }}">

@endsection


@section('content')


    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">

                <div class="card-body">
                    <x-back-previous-url />
                    <div class="div-for-id">
                        <span>{{ __('content.face') }}: ID: {{$first_id}}</span>
                        <span>{{ __('content.face') }}: ID: {{$second_id}}</span>
                    </div>

                    <form action="{{route('fusion.fusion', [$table_name, $first_id, $second_id])}}" class="result-form" method="POST">
                        <div class="trs-div">

                            @foreach ($data as $key => $value)
                                @if (in_array($key, $uniqueFields))
                                    <div class="trs-div-item">
                                        <label for="radio-div">{{ __("content.$key") }}</label>

                                        <div class="radio-div" id="radio-div">
                                            <div class="radio-div-1">
                                                <input id="arm_{{$key}}" type="radio" {{ $value[0] ? 'checked' : '' }}
                                                 name="{{$key}}"

                                                value="{{ $value[0] ? (is_array($value[0]) ? $value[0][key($value[0])] : $value[0]) : '' }}"
                                                 >
                                                <label for="arm_{{$key}}">{{ $value[0] ? ( is_array($value[0]) ? key($value[0]) : $value[0]) : 'datark' }}</label>
                                            </div>

                                            <div class="radio-div-2">
                                                <label for="ru_{{$key}}">{{ $value[1] ? ( is_array($value[1]) ? key($value[1]) : $value[1]) : 'datark' }}</label>

                                                <input id="ru_{{$key}}" type="radio"
                                                name="{{$key}}"
                                                value="{{ $value[1] ? (is_array($value[1]) ? $value[1][key($value[1])] : $value[1]) : '' }}"
                                                {{ !$value[0] ? ( $value[1] ? 'checked' : '') : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="trs-div-item">
                                        <label for="radio-div">{{ __("content.$key") }}</label>

                                        <div class="checkbox-div" id="checkbox-div">
                                            <div class="checkbox-div-1">
                                                @if (is_array($value[0]))
                                                    @foreach ($value[0] as $k0 => $item)
                                                        <div>
                                                            <label
                                                                for="first_{{$key}}">ID: {{$item}} - {{ $k0 ?? 'datark' }}</label>

                                                                {{-- <input id="am" value="{{ $item ?? '' }}" name="{{$key}}[{{ $item ? $item : 0 }}]" type="checkbox" {{ $item ? 'checked' : '' }}> --}}

                                                                <input id="first_{{$key}}" value="{{ $item ?? '' }}" name="{{$key}}[]" type="checkbox" {{ $item ? 'checked' : '' }}>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div>
                                                        <label for="first1_{{$key}}">ID: {{ $value[0] ?? 'datark' }}</label>
                                                        <input id="first1_{{$key}}" type="checkbox" name="{{ $value[0] ?? '' }}" {{ $value[0] ? 'checked' : '' }}>
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="checkbox-div-2">
                                                @if (is_array($value[1]))
                                                    @foreach ($value[1] as $k1 => $item1)
                                                        <div>
                                                            <label for="second_{{$key}}">ID: {{$item1}} - {{ $k1 ?? 'datark' }}</label>
                                                            <input id="second_{{$key}}" type="checkbox" {{ $item1 ? 'checked' : '' }} value="{{ $item1 ?? '' }}" name="{{$key}}[]">

                                                            {{-- <input id="am" type="checkbox" {{ $item1 ? 'checked' : '' }} name="{{$key}}[{{ $item1 ? $item1 : 0 }}]"> --}}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div>
                                                        <label for="second2_{{$key}}">ID: {{ $value[1] ?? 'datark' }}</label>
                                                        <input id="second2_{{$key}}" type="checkbox" name="{{ $value[1] ?? '' }}" {{ $value[1] ? 'checked' : '' }}>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endforeach


                        </div>

                        <button type="submit"
                            class="submit-btn submit-btn-result-page btn btn-primary">{{ __('content.fusion') }}</button>
                </div>
                </form>
            </div>
        </div>

    </section>


@section('js-scripts')
    <script src='{{ asset('assets/js/fusion/index.js') }}'></script>
@endsection

@endsection
