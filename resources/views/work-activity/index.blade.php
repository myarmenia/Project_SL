@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/man/style.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/organization/organization.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Անձի աշխատանքային գործունեություն</h1>
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
                <form class="form" method="POST"  action="{{route('work.store', ['model' => $modelData->name,'id'=>$modelData->id,'redirect'=>$redirect])}}">
                @csrf
                    <button type="submit" class="submit-btn"><i class="bi bi-arrow-left"></i></button>
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control save_input_data"
                                        id="inputDate2"
                                        placeholder=""
                                        name="title"
                                />
                                <label for="inputDate2" class="form-label"
                                >1) Պաշտոն</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputDate2"
                                    placeholder=""
                                    name="period"
                                />
                                <label for="inputDate2" class="form-label"
                                >2) Տեղեկությունները վերաբերվում են ժամանակաշրջանին</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input
                                        type="date"
                                        placeholder=""
                                        id="inputDate1"
                                        class="form-control"
                                        name="start_date"
                                />
                                <label for="inputDate1" class="form-label"
                                >3) Աշխատանքային գործունեության սկիզբ</label
                                >
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input
                                        type="date"
                                        placeholder=""
                                        id="inputDate1"
                                        class="form-control"
                                        name="end_date"
                                />
                                <label for="inputDate1" class="form-label"
                                >4) Աշխատանքային գործունեության ավարտ</label>
                            </div>
                        </div>
                        
                        <div class="btn-div">
                            @if($modelData->name === 'man')
                                <label class="form-label">5) Աշխատանքը կազմակերպությունում</label>
                                <a href="{{ route('open.page', ['page' => 'organization', 'route_name' => $modelData->name, 'main_route' => 'work.create', 'model_id' => $modelData->id, 'redirect'=>$redirect]) }}">{{ __('content.addTo') }}</a>
                                
                                <x-teg :item="$teg" :inputName="$modelData->name === 'man' ? 'organization_id' : 'man_id'" name="id" label="" :redirect="['route'=>'work.create', 'model' => $modelData->name, 'id'=>$modelData->id, 'redirect'=> $redirect]" delete/>
                            @else
                                <label class="form-label">5) Տվյալներ անձի աշխատանքային գործունեության վերաբերյալ</label>
                                <a href="{{ route('open.page', ['page' => 'man', 'route_name' => $modelData->name, 'main_route' => 'work.create', 'model_id' => $modelData->id, 'redirect'=>$redirect]) }}">{{ __('content.addTo') }}</a>

                                <x-teg :item="$teg" :inputName="$modelData->name === 'man' ? 'organization_id' : 'man_id'" name="id" label="" :redirect="['route'=>'work.create', 'model' => $modelData->name, 'id'=>$modelData->id, 'redirect'=> $redirect]" delete/>
                            @endif
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

    @section('js-scripts')
        <script>
            let parent_id = "{{$modelData->id}}"
        </script>
        <script src="{{ asset('assets/js/saveFields.js') }}"></script>
        <script src="{{ asset('assets/js/script.js') }}"></script>
    @endsection
@endsection

