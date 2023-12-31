@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/external-signs/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/calendar.css') }}">

@endsection


@section('content')



    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <x-form-error/>
{{--                @dd($modelData)--}}
                <form class="form" method="POST" @if(request()->route()->getName() === 'man.sign.create') action="{{route('man.sign.store',['model' => $modelData->name,'id'=>$modelData->id])}}" @else action="{{route('sign.update', [$manExternalSignHasSign->id,'model' => $modelData->name,'id'=>$modelData->id])}}" @endif>
                    @csrf
                    @if($edit)
                        @method('PUT')
                    @endif
                    <x-back-previous-url submit/>

                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper calendar-container">
                                <input
                                        type="text"
                                        placeholder=""
                                        id="inputDate1"
                                        class="form-control calendarInput form-input"
                                        name="fixed_date"
                                        @if($edit)
                                            value="{{$manExternalSignHasSign->fixed_date}}"
                                        @endif
                                        data-check="date"
                                        autocomplete="off" onblur="handleBlur(this)"
                                />
                                <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>
                                <label for="inputDate1" class="form-label"
                                >1) {{__('content.time_fixation')}}</label
                                >
                                <!-- </div> -->
                            </div>
                        </div>


                        <div class="col">
                            <div class="form-floating">
                                <input
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="sign_id"
                                    @if($edit)
                                        value="{{$manExternalSignHasSign->sign_id}}"
                                    @endif
                                >
                                <input
                                    type="text"
                                    class="form-control get_datalist set_value"
                                    id="sign"
                                    placeholder=""
                                    data-id=""
                                    tabindex="2"
                                    data-table="sign"
                                    data-model="sign"
                                    list="sign-list"
                                    @if($edit)
                                        value="{{$manExternalSignHasSign->sign->name}}"
                                    @endif
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='sign'
                                    data-fieldname='name'
                                ></i>
                                <label for="sign" class="form-label"
                                >2) {{__('content.signs')}}</label
                                >
                            </div>
                            <datalist id="sign-list" class="input_datalists" style="width: 500px;">
                            </datalist>
                        </div>

                        <div class="col btn-div">
                            <label for="inputDate2" class="form-label">3) {{__('content.ties')}}</label>
                            @if($edit)
                                <x-tegs-relations :model="$modelData->model"/>
                            @endif
                        </div>
                    </div>
                    <!-- Vertical Form -->
                </form>
            </div>
        </div>
    </section>

        <x-scroll-up/>
        <x-fullscreen-modal/>
        <x-errorModal/>



    @section('js-scripts')
        <script>
            {{--let parent_id = "{{$man->id}}"--}}
        </script>

        {{--        <script src="{{ asset('assets/js/external-signs/script.js') }}"></script>--}}
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src='{{ asset('assets/js/main/date.js') }}'></script>

    @endsection
@endsection

