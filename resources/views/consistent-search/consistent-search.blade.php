@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/consistent-search/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Հետևեղական որոնում</h1>
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
                <form class="form consistent-form" >
                    @csrf
                    <div class="inputs row g-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" id="input1"
                                    placeholder="" name="input1" tabindex="1"
                                    value="" />
                                <label for="input1" class="form-label">1) Որոնման տեքստ</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select form-control select_class" id="selectElement"
                                    name="selectInfo">
                                    <option selected disabled value="" hidden></option>
                                    <option value="">Անձ</option>
                                    <option value="">Կազմակերպություն</option>
                                    <option value="">Հեռախոսահամար</option>
                                    <option value="">Ավտոմեքենաների համար</option>
                                    <option value="">Ապրանք</option>
                                    <option value="">Ապրանքանիշ</option>
                                </select>
                                <label class="form-label">19) Շտեմարանի դաշտ</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="tegs-div"><div class="tegs-div-content">
                            </div></div>
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title get_datalist save_input_data"
                                    id="input3"
                                    placeholder=""
                                    name="source_agency_id"
                                    list="brow1"
                                    tabindex="3"
                                    value=""
                                    data-modelid="" />
                                <label for="input3" class="form-label">3) Հետևող օ/ա</label>

                            </div>
                            <datalist id="brow1" class="input_datalists" style="width: 500px;">
                                <option>hhhhhhhhhhh</option>
                            </datalist>
                        </div>

                        <div class="col">
                                <div class="form-floating input-date-wrapper">
                                    <!-- <div class="input-date-wrapper"> -->
                                    <!-- <label for="inputDate1" role="value"></label>
                                    <input type="text" hidden role="store" /> -->
                                    <input
                                    type="date"
                                    placeholder=""
                                    id="inputDate1"
                                    class="form-control"
                                    placaholder=""
                                    name="inp4"
                                    />
                                    <label for="inputDate1" class="form-label"
                                    >3) Հսկողության վերջնաժամկետ</label
                                    >
                                    <!-- </div> -->
                                </div>
                        </div>
                        
                    </div>
                    <button type="submit" class="submit-btn consistent-searche-submit">Ավելացնել</button>
                </form>
                <!-- Vertical Form -->
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <x-form-error/>
                <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <div class="table_div table-div-consistent">

                        <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/"
                            data-status-url="users/change-status/" data-table-name="user" data-section-name="open">
                            <thead>
                                <tr>
                                    <th class="filter-th" data-sort="null" data-type="filter-id" style = 'width:30px' >
                                        Id
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        Որոնման տեքստ
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        Հետևող օ/ա
                                    </th>
                                    
                                    <th class="filter-th" data-sort="null" data-type="standart" style = 'width:30px'  >
                                    </th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                
                                    <tr class="current-id" data-id="">
                                        <td>1</td>
                                        <td>nkar</td>
                                        <td>Romeo</td>
                                        <td title="Հսկողության դադարեցում" ><i class="bi bi-trash3"></i></td>
                                    </tr>

                                    <tr class="current-id" data-id="">
                                        <td>2</td>
                                        <td>nkar2</td>
                                        <td>Alfred</td>
                                        <td title="Հսկողության դադարեցում"><i class="bi bi-trash3"></i></td>
                                    </tr>
                                

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>



    @section('js-scripts')
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{{ asset('assets/js/consistent-search/script.js') }}"></script>
    @endsection
@endsection

