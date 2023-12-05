@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/availability-gun/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection

@section('content')

    

    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
             <x-form-error />
                <!-- Vertical Form -->
                <form action="{{Route::currentRouteName() !== 'weapon.create' ? route('weapon.update', [$modelData->model->id,'model' => $modelData->name ?? null,'id'=>$modelData->id ?? null]) : route('weapon.store',['model' => $modelData->name ?? null,'id'=>$modelData->id ?? null,'relation'=>$modelData->relation]) }}" method="POST">
                    @if (Route::currentRouteName() !== 'weapon.create')
                        @method('PUT')
                    @endif
                    <x-back-previous-url submit/>
                    <div class="inputs row g-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item1" name="category"
                                    value="{{ $modelData->model->category }}" />
                                <label for="item1" class="form-label">1) Զենքի հանձման տեսակ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item2" name="view"
                                    value="{{ $modelData->model->view }}" />
                                <label for="item2" class="form-label">2) Տեսակ</label>
                            </div>
                        </div>


                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item3" name="type"
                                    value="{{ $modelData->model->type }}" />
                                <label for="item3" class="form-label">3) Տարատեսակ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item4" name="weapon_model"
                                    value="{{ $modelData->model->model }}" />
                                <label for="item4" class="form-label">4) Մակնիշ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item5" name="reg_num"
                                    value="{{ $modelData->model->reg_num }}" />
                                <label for="item5" class="form-label">5) Հաշվառման համարը</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="item6" name="count"
                                    value="{{ $modelData->model->count}}" />
                                <label for="item6" class="form-label">6) Քանակը</label>
                            </div>
                        </div>

                        @if(Route::currentRouteName() !== 'weapon.create')
                            <div class="col flex justify-content-between">
                                <label for="inputDate2" class="form-label"
                                >7) {{__('content.ties')}}</label>
                                <x-tegs-relations :model="$modelData->model"/>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>

    <x-scroll-up />
    <x-fullscreen-modal />
    <x-errorModal />

@section('js-scripts')
    <script src='{{ asset('assets/js/availability-gun/script.js') }}'></script>
@endsection
@endsection
