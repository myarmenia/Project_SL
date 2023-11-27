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
                        <button class="btn btn-primary">{{ __('content.some') }}</button>
                        <button class="btn btn-primary">{{ __('content.present') }}</button>
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
                            @foreach ($check_user_list as $item )

                                        <tr>
                                            <td class="checkboxTd">
                                                <div>
                                                    <div>
                                                        <input class="form-check-input" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}"  value="present">
                                                        <span>{{ __('content.present') }}</span>
                                                    </div>
                                                    <div>
                                                        <input class="form-check-input" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}"  value="some">
                                                        <span>{{ __('content.some') }}</span>
                                                    </div>
                                                    <div>
                                                        <input class="form-check-input" type="radio" {{ $item->status=="new" ? "checked" : null}} name="list_{{$item->id}}" data-id="{{$item->id}}" value="absentees">
                                                        <span>{{ __('content.absentees') }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$item->status=="new" ? "new": null}}</td>
                                            <td></td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->surname}}</td>
                                            <td>{{$item->patronymic}}</td>
                                            <td>{{$item->birthday_str}}</td>

                                            <td></td>
                                        </tr>

                                        @if ($item->man()->exists())
                                            @foreach ($item->man as $data)
                                                <tr>
                                                    <td class="checkboxTd">
                                                        <div>
                                                            <div>
                                                                {{-- <input class="form-check-input" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}"  value="present">
                                                                <span>{{ __('content.present') }}</span> --}}
                                                            </div>
                                                            <div>
                                                                {{-- <input class="form-check-input" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}"  value="some">
                                                                <span>{{ __('content.some') }}</span> --}}
                                                            </div>
                                                            <div>
                                                                {{-- <input class="form-check-input" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}" value="absentees">
                                                                <span>{{ __('content.absentees') }}</span> --}}
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>{{$item->status}}</td>
                                                    <td>{{$data->pivot->procent}}</td>
                                                    <td>{{$data->FirstName->first_name}}</td>
                                                    <td>{{$data->lastName->last_name}}</td>
                                                    <td>{{$data->MiddleName ? $data->MiddleName->middle_name : null}}</td>
                                                    <td>{{$data->birthday_str}}</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        @endif
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
        let button_generate_file = "{{ route('generate_file_via_status')}}"
        let update_checked_user_list = "{{ route('update_checked_user_list')}}"
        console.log(button_generate_file);

    </script>
    <script src="{{ asset('assets/js/user_list/index.js') }}"></script>
@endsection
@endsection
