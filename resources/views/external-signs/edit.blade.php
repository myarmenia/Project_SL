@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/external-signs/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Արտաքին նշաններ</h1>
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
                <form class="form" method="POST" @if(request()->route()->getName() === 'man.sign.create') action="{{route('man.sign.store', $man->id)}}" @else action="{{route('sign.update',$manExternalSignHasSign->id)}}" @endif>
                    @csrf
                    @method('PUT')
                    <button type="submit" class="submit-btn"><i class="bi bi-arrow-left"></i></button>

                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input
                                        type="date"
                                        placeholder=""
                                        id="inputDate1"
                                        class="form-control"
                                        name="fixed_date"
                                        @if($edit)
                                            value="{{$manExternalSignHasSign->fixed_date}}"
                                        @endif
                                />
                                <label for="inputDate1" class="form-label"
                                >1) Արձանագրման օր, ամիս, տարի</label
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
                                >2) Արտաքին նշաններ</label
                                >
                            </div>
                            <datalist id="sign-list" class="input_datalists" style="width: 500px;">
                            </datalist>
                        </div>

                        <div class="col btn-div">
                            <label for="inputDate2" class="form-label">3) Կապեր</label>
                            @if($edit)
                                <x-teg :item="$manExternalSignHasSign->man" inputName="man" name="id" :label="__('content.man')"/>
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
    @endsection
@endsection

