@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/consistent-notifications/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Ծանուցումներ</h1>
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
                <div class="d-flex justify-content-between align-items-center my-3"></div>

<div class="table_div table-div-consistent">

    <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/"
        data-status-url="users/change-status/" data-table-name="user" data-section-name="open">
        <thead>
            <tr>
                <th class="filter-th" data-sort="null" data-type="filter-id"  >
                Որոնման տեքստ
                </th>
                <th class="filter-th" data-sort="null" data-type="standart">
                    Փաստաթուխթ
                </th>
                <th class="filter-th" data-sort="null" data-type="standart">
                    Ամսաթիվ
                </th>
                
                <th class="filter-th" data-sort="null" data-type="standart" style = 'width:30px'  >

                </th>
                
                
            </tr>
        </thead>
        <tbody class="tbody">
            
                <tr class="current-id" data-id="">
                    <td>nkar</td>
                    <td>
                        <a href="#">ֆայլի անուն</a>
                    </td>
                    <td>01.10.23</td>
                    <td><i class="bi bi-trash3"></i></td>
                </tr>

                <tr class="current-id" data-id="">
                    <td>nkar2</td>
                    <td>
                    <a href="#">ֆայլի անուն-2</a>
                    </td>
                    <td>02.11.23</td>
                    <td><i class="bi bi-trash3"></i></td>
                </tr>
            

        </tbody>
    </table>

</div>
</div>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>



    @section('js-scripts')
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{{ asset('assets/js/consistent-notifications/script.js') }}"></script>
    @endsection
@endsection

