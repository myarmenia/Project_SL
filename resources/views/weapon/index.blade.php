@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/availability-gun/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection

@section('content')

    @if (isset($weapon))
    <x-breadcrumbs :title="__('content.presence_weapons')" :crumbs="[
    ['name' => __('content.weapon'),'route' => 'open.page', 'route_param' => 'weapon'],
    ]" :id="$weapon->id" />
    @else
        <x-breadcrumbs :title="__('content.presence_weapons')" :crumbs="[
    ['name' => __('content.weapon'),'route' => 'open.page', 'route_param' => 'weapon']
    ]"  />
    @endif

    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">

                    <x-form-error />

                <!-- Vertical Form -->
                <form action="{{ isset($weapon) ? route('weapon.update', $weapon->id) : route('weapon.store') }}"
                    method="Post">
                    <x-back-previous-url submit/>
                    @if (isset($weapon))
                        @method('patch')
                    @endif
                    <div class="inputs row g-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item1" name="category"
                                    value="{{ $weapon->category ?? '' }}" />
                                <label for="item1" class="form-label">1) Զենքի հանձման տեսակ</label>

                            </div>
                            @error('category')
                                {{-- <span class="invalid-feedback" role="alert"> --}}
                                <strong>{{ $message }}</strong>
                                {{-- </span> --}}
                            @enderror
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item2" name="view"
                                    value="{{ $weapon->view ?? '' }}" />
                                <label for="item3" class="form-label">2) Տեսակ</label>
                            </div>
                        </div>


                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item3" name="type"
                                    value="{{ $weapon->type ?? '' }}" />
                                <label for="item3" class="form-label">3) Տարատեսակ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item4" name="model"
                                    value="{{ $weapon->model ?? '' }}" />
                                <label for="item4" class="form-label">4) Մակնիշ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item5" name="reg_num"
                                    value="{{ $weapon->reg_num ?? '' }}" />
                                <label for="item5" class="form-label">5) Հաշվառման համարը</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item6" name="count"
                                    value="{{ $weapon->count ?? '' }}" />
                                <label for="item6" class="form-label">6) Քանակը</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">7) Կապեր</label>
                        </div>
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
