@extends('layouts.auth-app')

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.action') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a >{{ __('sidebar.open') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.action') }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table">
                            <thead>
                                <tr>
                                    <th class="filter-th">{{ __('sidebar.operator') }}</th>

                                    <th class="filter-th">Id</th>

                                    <th class="filter-th">
                                        {{ __('content.content_materials_actions') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.qualification_fact') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.short_man') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.start_action_date') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.end_action_date') }}
                                    </th>

                                    <th class="filter-th" >
                                        {{ __('content.duration_action') }}</th>

                                    <th class="filter-th" >
                                        {{ __('content.purpose_motive_reason') }}</th>

                                    <th class="filter-th">
                                        {{ __('content.terms_actions') }}</th>

                                    <th class="filter-th"  >
                                        {{ __('content.ensuing_effects') }}</th>

                                    <th class="filter-th">
                                        {{ __('content.source_information_actions') }}</th>

                                    <th class="filter-th">
                                        {{ __('content.opened_dou') }}</th>


                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>26409</td>
                                    <td>knjnjnjnjnjn</td>
                                    <td>269</td>
                                    <td>2649</td>
                                    <td>Garik</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                    <td>flkjgnbh</td>
                                </tr>



                            </tbody>
                        </table>

                    </div>


                </div>
                <div id="countries-list"></div>
            </div>
        </div>
    </section>
    <div>

    @section('js-scripts')
        <script src='{{ asset('assets/js/regenerate/regenerate-dinamic-table.js') }}'></script>
    @endsection

@endsection
