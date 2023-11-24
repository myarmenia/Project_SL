@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/fusion/result.css') }}">
    /
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('content.fusion') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('content.fusion') }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="div-for-id">
                        <span>{{ __('content.face') }}: ID: 535</span>
                        <span>{{ __('content.face') }}: ID: 444</span>
                    </div>

                    <form action="" class="result-form">
                        <div class="trs-div">
                            @foreach ($data as $key => $value)
                                @php
                                    $first_id = $key == 'id' ? $value[0] : null;
                                    $second_id = $key == 'id' ? $value[1] : null;

                                @endphp
                                @if (!is_array($value))
                                    <div class="trs-div-item">
                                        <label for="radio-div">{{ __("content.$key") }}</label>

                                        <div class="radio-div" id="radio-div">
                                            <div class="radio-div-1">
                                                <input id="arm" type="radio" name="country">
                                                {{-- <label for="arm">{{ $value[0] ?? 'datark' }}</label> --}}
                                            </div>

                                            <div class="radio-div-1">
                                                {{-- <label for="ru">{{ $value[1] ?? 'datark' }}</label> --}}

                                                <input id="ru" type="radio" name="country">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="trs-div-item">
                                        <label for="radio-div">{{ __("content.$key") }}</label>

                                        <div class="checkbox-div" id="checkbox-div">
                                            <div class="checkbox-div-1">
                                                @foreach ($value as $item)
                                                    @if (isset($item->pivot) && $item->pivor->man_id == $first_id)
                                                        <div>
                                                            <label for="am">Հայերեն</label>
                                                            <input id="am" type="checkbox">
                                                        </div>
                                                    @endif
                                                    
                                                @endforeach
                                            </div>

                                            <div class="checkbox-div-2">
                                                <div>
                                                    <label for="am">Հայերեն</label>
                                                    <input id="am" type="checkbox">
                                                </div>

                                                <div>
                                                    <label for="rus">Ռուսերեն</label>
                                                    <input id="rus" type="checkbox">
                                                </div>

                                                <div>
                                                    <label for="en">Անգլերեն</label>
                                                    <input id="en" type="checkbox">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endforeach
                            <div class="trs-div-item">
                                <label for="radio-div">Ազգություն</label>

                                <div class="radio-div" id="radio-div">
                                    <div class="radio-div-1">
                                        <label for="arm">Հայ</label>
                                        <input id="arm" type="radio" name="country">
                                    </div>

                                    <div class="radio-div-1">
                                        <label for="ru">Ռուս</label>
                                        <input id="ru" type="radio" name="country">
                                    </div>
                                </div>
                            </div>

                            <div class="trs-div-item">
                                <label for="radio-div">Սեռ</label>

                                <div class="radio-div" id="radio-div">
                                    <div class="radio-div-1">
                                        <label for="man">Արական</label>
                                        <input id="man" type="radio" name="gender">
                                    </div>

                                    <div class="radio-div-1">
                                        <label for="female">Իգական</label>
                                        <input id="female" type="radio" name="gender">
                                    </div>
                                </div>
                            </div>

                            <div class="trs-div-item">
                                <label for="checkbox-div">Լեզուների իմացություն</label>

                                <div class="checkbox-div" id="checkbox-div">
                                    <div class="checkbox-div-1">
                                        <div>
                                            <label for="am">Հայերեն</label>
                                            <input id="am" type="checkbox">
                                        </div>

                                        <div>
                                            <label for="rus">Ռուսերեն</label>
                                            <input id="rus" type="checkbox">
                                        </div>

                                        <div>
                                            <label for="en">Անգլերեն</label>
                                            <input id="en" type="checkbox">
                                        </div>
                                    </div>

                                    <div class="checkbox-div-2">
                                        <div>
                                            <label for="am">Հայերեն</label>
                                            <input id="am" type="checkbox">
                                        </div>

                                        <div>
                                            <label for="rus">Ռուսերեն</label>
                                            <input id="rus" type="checkbox">
                                        </div>

                                        <div>
                                            <label for="en">Անգլերեն</label>
                                            <input id="en" type="checkbox">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="trs-div-item">
                                <label for="checkbox-div">Իրադարձություն</label>

                                <div class="checkbox-div" id="checkbox-div">
                                    <div class="checkbox-div-1">
                                        <div>
                                            <label for="event_id_1">ID: 2</label>
                                            <input id="event_id_1" type="checkbox">
                                        </div>

                                        <div>
                                            <label for="event_id_2">ID: 10</label>
                                            <input id="event_id_2" type="checkbox">
                                        </div>
                                    </div>

                                    <div class="checkbox-div-2">
                                        <div>
                                            <label for="event_id_3">ID: 2</label>
                                            <input id="event_id_3" type="checkbox">
                                        </div>

                                        <div>
                                            <label for="event_id_4">ID: 10</label>
                                            <input id="event_id_4" type="checkbox">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="trs-div-item">
                                <label for="checkbox-div">Քրեական գործ</label>

                                <div class="checkbox-div" id="checkbox-div">
                                    <div class="checkbox-div-1">
                                        <div>
                                            <label for="criminalCase_id_1">ID: 2</label>
                                            <input id="criminalCase_id_1" type="checkbox">
                                        </div>
                                    </div>

                                    <div class="checkbox-div-2">
                                        <div>
                                            <label for="criminalCase_id_2">ID: 2</label>
                                            <input id="criminalCase_id_2" type="checkbox">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <button type="submit"
                            class="submit-btn submit-btn-result-page">{{ __('content.fusion') }}</button>
                </div>
                </form>
            </div>
        </div>

    </section>


@section('js-scripts')
    <script src='{{ asset('assets/js/fusion/index.js') }}'></script>
@endsection

@endsection
