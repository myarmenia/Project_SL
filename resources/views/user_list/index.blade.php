@extends('layouts.auth-app')

@section('style')
    <link href="{{ asset('assets/css/user_list/index.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')


    <section class="section">
        <div class="col">
            <div class="card">

                <div class="card-body">
                    <x-back-previous-url  />
                    <div class="buttons">

                        <button class="btn btn-primary btns" name="new">{{ __('content.new') }}</button>
                        <button class="btn btn-primary btns" name="some">{{ __('content.some') }}</button>
                        <button class="btn btn-primary btns" name="like">{{ __('content.like') }}</button>

                    </div>
                    <table class="table" data-table-name="man">
                        <thead>
                            <tr>
                                {{-- <th>
                                    n
                                </th> --}}
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
                                            {{-- <td>{{ $item->id }}</td> --}}
                                            <td class="checkboxTd">
                                                <div>
                                                    <div>
                                                        <input class="form-check-input radioBtns" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}"  value="like">
                                                        <span>{{ __('content.radio_like') }}</span>
                                                    </div>
                                                    <div>
                                                        <input class="form-check-input radioBtns" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}"  value="some">
                                                        <span>{{ __('content.radio_some') }}</span>
                                                    </div>
                                                    <div>
                                                        <input class="form-check-input radioBtns" type="radio" {{ $item->status=="new" ? "checked" : null}} name="list_{{$item->id}}" data-id="{{$item->id}}" value="new">
                                                        <span>{{ __('content.radio_new') }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$item->status == "new" ?  __('content.singular_new')   : null}}</td>
                                            <td></td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->surname}}</td>
                                            <td>{{$item->patronymic}}</td>
                                            <td>{{$item->birthday_str}}</td>

                                            <td>

                                            </td>
                                        </tr>

                                        @if ($item->man()->exists())
                                            @foreach ($item->man as $data)
                                                <tr>
                                                    <td>
                                                    </td>
                                                    <td>{{$item->status=="like" ? __('content.singular_like'):($item->status=="some" ?  __('content.singular_some'):null) }}</td>
                                                    <td>{{$data->pivot->procent}}</td>
                                                    <td>{{$data->FirstName->first_name}}</td>
                                                    <td>{{$data->lastName->last_name}}</td>
                                                    <td>{{$data->MiddleName ? $data->MiddleName->middle_name : null}}</td>
                                                    <td>{{$data->birthday_str}}</td>
                                                    <td>
                                                        <a target="blank">
                                                            <i class="bi bi-eye open-eye" data-id="{{ $data->id }}"></i>
                                                            <span></span>
                                                        </a>

                                                    </td>
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
    <x-errorModal />

@section('js-scripts')
    <script>

        let button_generate_file = "{{ route('generate_file_via_status')}}"
        let update_checked_user_list = "{{ route('update_checked_user_list')}}"
        let answer_message= "{{__('messages.file_has_been_gererated')}}"
        let response_file_not_generated = "{{ __('messages.response_file_not_generated') }}"

    </script>
    <script src="{{ asset('assets/js/user_list/index.js') }}"></script>
    <script src="{{ asset('assets/js/error_modal.js') }}"></script>
    <script src="{{ asset('assets/js/contact/contact.js') }}"></script>
@endsection
@endsection
