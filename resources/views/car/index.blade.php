@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/availability-car/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection

@section('content')


    @if (isset($car))
        <x-breadcrumbs :title="__('content.presence_machine')" :crumbs="[
    ['name' => __('content.car'),'route' => 'open.page', 'route_param' => 'car'],
    ]" :id="$car->id" />
    @else
        <x-breadcrumbs :title="__('content.presence_machine')" :crumbs="[
    ['name' => __('content.car'),'route' => 'open.page', 'route_param' => 'car']
    ]"  />
    @endif
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">

                <!-- Vertical Form -->
                <form action="{{ route('car.store') }}" method="POST">
                    <x-back-previous-url submit/>
                    <div class="inputs row g-3">

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="item1" placeholder="" data-id="1" value="{{ $car->car_category->name ?? '' }}" list="car_category"
                                    data-modelid="1" name="category_id" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='car_category' data-fieldname='name'></i>
                                <label for="item1" class="form-label">1) Տրանսպորտային միջոցի տեսակ</label>
                            </div>

                            <datalist id="car_category" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="item2" placeholder="" data-id="1" value="{{ $car->car_mark->name ?? '' }}" list="car_mark"
                                    data-modelid="1" name="mark_id" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-section = 'get-model-name-in-modal'
                                    data-table-name='car_mark' data-fieldname='name'></i>
                                <label for="item2" class="form-label">2) Մակնիշ</label>


                            </div>

                            <datalist id="car_mark" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item3" name="color_id" value="{{ $car->car_color->name ?? '' }}" />
                                <label for="item3" class="form-label">3) Գույն կամ այլ տարբերող նշաններ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item4" name="number" value="{{ $car->number ?? '' }}" />
                                <label for="item4" class="form-label">4) Պետհամարանիշ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item5" name="count" value="{{ $car->count ?? '' }}" />
                                <label for="item5" class="form-label">5) Քանակ</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="item6" name="note" value="{{ $car->note ?? '' }}" />
                                <label for="item6" class="form-label">6) Լրացուցիչ տվյալներ</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">7) Կապեր</label>
                            <div class="tegs-div" name="tegsDiv1" id="company-police"></div>
                        </div>
                        <!-- Vertical Form -->
                    </div>

                </form>
            </div>
        </div>
    </section>

    {{-- let parent_id = "{{ $event->id }}" --}}


    <x-scroll-up />
    <x-fullscreen-modal />
    <x-errorModal />

@section('js-scripts')
    <script>
        let ties = "{{ __('content.ties') }}"
        let parent_table_name = "{{ __('content.car') }}"
    </script>

    <script src='{{ asset('assets/js/script.js') }}'></script>
    <script src="{{ asset('assets/js/error_modal.js') }}"></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
    <script src='{{ asset('assets/js/availability-car/script.js') }}'></script>
@endsection
@endsection
