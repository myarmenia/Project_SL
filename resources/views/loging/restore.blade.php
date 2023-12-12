@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/users/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')



    <!-- End Page Title -->

    <!-- List of users -->
    <section class="section">
        <div class="col">
            <div class="card">

                <div class="card-body">
                    <x-back-previous-url />
                    <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <div class="table_div">

                        <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/"
                            data-status-url="bbb/status/" data-table-name="users-table" data-section-name="dictionary">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Ip</th>

                                    <th>{{ __("table.user_name") }}</th>
                                    <th>{{ __("table.name") }}</th>
                                    <th>{{ __("table.last_name") }}</th>
                                    <th>{{ __("table.role") }}</th>
                                    <th>{{ __("table.action") }}</th>
                                    <th>{{ __("table.table_name") }}</th>
                                    <th>{{ __("table.date_and_time_date") }}</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getLogsById as $log)
                                    <tr class="current-id " data-id="{{ $log->id }}" data-info="{{ $log->data }}">
                                        <td>{{ $log->id }}</td>
                                        <td>{{ $log->user_ip }}</td>
                                        <td>{{ $log->user->username ?? '' }}</td>
                                        <td>{{ $log->user->first_name ?? '' }}</td>
                                        <td>{{ $log->user->last_name ?? '' }}</td>
                                        <td>{{ $log->user ? implode(', ', $log->user->roles->pluck('name')->toArray()) : '' }}
                                        </td>
                                        <td>{{ $log->type ? __("table.$log->type") : '' }}</td>
                                        <td>{{ $log->tb_name ? __("table.$log->tb_name") : '' }}</td>
                                        <td>{{ date('d-m-Y', strtotime($log->created_at)) }}</td>
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
    <script>
        let dinamic_field_name = "{{ __('content.field_name') }}"
        let dinamic_content = "{{ __('content.content') }}"
    </script>

    <script src='{{ asset('assets/js/users/index.js') }}'></script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    {{-- <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script> --}}
@endsection

@endsection
