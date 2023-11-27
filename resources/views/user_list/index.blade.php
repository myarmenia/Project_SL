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
                        <button id="absentees_id_button" name="absentees"
                            class="btn btn-primary btns">{{ __('content.absentees') }}</button>
                        <button id="some_id_button" name="some"
                            class="btn btn-primary btns">{{ __('content.Some') }}</button>
                        <button id="present_id_button" name="present"
                            class="btn btn-primary btns">{{ __('content.Present') }}</button>
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
                            @foreach ($check_user_list as $item)
                                {{-- {{dd($item)}} --}}
                                <tr>
                                    <td class="checkboxTd">
                                        <div>
                                            <div>
                                                <input id="{{ $item->id }}" class="form-check-input radioBtns" type="radio"
                                                    name="list_{{ $item->id }}" data-id="{{ $item->id }}"
                                                    value="absentees">
                                                <span>{{ __('content.absentees') }}</span>
                                            </div>
                                            <div>
                                                <input id="{{ $item->id }}" class="form-check-input radioBtns" type="radio"
                                                    name="list_{{ $item->id }}" data-id="{{ $item->id }}"
                                                    value="some">
                                                <span>{{ __('content.some') }}</span>
                                            </div>
                                            <div>
                                                <input id="{{ $item->id }}" class="form-check-input radioBtns" type="radio"
                                                    name="list_{{ $item->id }}" data-id="{{ $item->id }}"
                                                    value="present">
                                                <span>{{ __('content.present') }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $item->status }}</td>
                                    <td></td>
                                    {{-- {{dd($item->man)}} --}}
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->surname }}</td>
                                    <td>{{ $item->patronymic }}</td>
                                    <td>{{ $item->birthday_str }}</td>
                                    <td></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- End Bordered Table -->
                </div>
            </div>

            {{-- @yield('permissions-content') --}}

        </div>
    </section>

@section('js-scripts')
    <script>
        let button_generate_file = "{{ route('generate_file_via_status') }}"
        let update_checked_user_list = "{{ route('update_checked_user_list')}}"
        // console.log(button_generate_file);
    </script>
    <script src="{{ asset('assets/js/user_list/index.js') }}"></script>
@endsection
@endsection
