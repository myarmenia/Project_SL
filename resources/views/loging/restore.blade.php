@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/users/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Գործածողների ցուցակ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item active">
                        Գործածողների ցուցակ
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- List of users -->

    @foreach ($getLogsById as $log)
        <p  class="logg">{{$log->data}} </p>
    @endforeach

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <div class="table_div">

                        <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/"
                            data-status-url="bbb/status/" data-table-name="users-table" data-section-name="dictionary">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        Id
                                        <i class="fa fa-filter" data-field-name="id" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        Ip
                                        <i class="fa fa-filter" data-field-name="id" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        Գործածողի անուն
                                        <i class="fa fa-filter" data-field-name="username" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        Անուն <i class="fa fa-filter" data-field-name="first_name" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        Ազգանուն<i class="fa fa-filter" data-field-name="last_name" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        Դեր<i class="fa fa-filter" data-field-name="roles" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        Գործողություն<i class="fa fa-filter" data-field-name="roles" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        Աղյուսակի անվանում<i class="fa fa-filter" data-field-name="roles" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        Մուտքագրման ամսաթիվ<i class="fa fa-filter" data-field-name="roles" aria-hidden="true"></i>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($getLogsById as $log)

                                    <tr class="current-id" data-id="1">

                                        <td><a
                                            title="վերականգնել"><i
                                                class="bi bi-arrow-down-up open-regenerate"></i></a></td>
                                        <td>{{$log->id}}</td>
                                        <td>{{$log->user_ip}}</td>
                                        <td>{{$log->user->username ?? ''}}</td>
                                        <td>{{$log->user->first_name ?? ''}}</td>
                                        <td>{{$log->user->last_name ?? ''}}</td>
                                        <td>{{$log->user ? implode(', ', $log->user->roles->pluck('name')->toArray()) : '' }}</td>
                                        <td>{{$log->type ? __("table.$log->type") : ''}}</td>
                                        <td>{{$log->tb_name ? __("table.$log->tb_name") : ''}}</td>
                                        <td>{{date('d-m-Y', strtotime($log->created_at))}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>



@section('js-scripts')
    <script src='{{ asset('assets/js/users/index.js') }}'></script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
@endsection

@endsection