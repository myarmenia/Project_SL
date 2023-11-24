@extends('layouts.auth-app')

@section('style')
    <link href="{{ asset('assets/css/user_list/index.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.search') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>---
                    <li class="breadcrumb-item active">{{ __('sidebar.search-file') }}</li>---
                </ol>
            </nav>
        </div>
    </div>

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="buttons">
                        <button class="btn btn-primary">{{ __('content.absentees') }}</button>
                        <button class="btn btn-primary">{{ __('content.Some') }}</button>
                        <button class="btn btn-primary">{{ __('content.Present') }}</button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>

                                </th>

                                <th scope="col">
                                    {{ __('content.status') }}
                                </th>

                                <th scope="col">
                                    %
                                </th>

                                <th scope="col">
                                    {{ __('content.first_name') }}
                                </th>

                                <th>
                                    {{ __('content.last_name') }}
                                </th>

                                <th>
                                    {{ __('content.middle_name') }}
                                </th>

                                <th>
                                    {{ __('content.date_of_birth_') }}
                                </th>

                                <th>
                                    {{ __('content.ties') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="checkboxTd">
                                    <div>
                                        <div>
                                            <input class="form-check-input" type="radio" name="exampleRadios">
                                            <span>{{ __('content.absentees') }}</span>
                                        </div>
                                        <div>
                                            <input class="form-check-input" type="radio" name="exampleRadios">
                                            <span>{{ __('content.Some') }}</span>
                                        </div>
                                        <div>
                                            <input class="form-check-input" type="radio" name="exampleRadios">
                                            <span>{{ __('content.Present') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Bordered Table -->
                </div>
            </div>

            {{-- @yield('permissions-content') --}}

        </div>
    </section>

@section('js-scripts')
    <script src="{{ asset('assets/js/user_list/index.js') }}"></script>
@endsection
@endsection
