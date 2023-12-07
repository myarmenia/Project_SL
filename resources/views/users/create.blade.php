@extends('layouts.auth-app')
@section('content')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/users/index.css') }}">
@endsection
    
    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <x-back-previous-url />
                    <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <form class="row g-3 needs-validation myclass" novalidate action="{{ route('users.store') }}"
                        method="POST">

                        <div class="col-12">
                            <div>
                                <div class="form-floating">
                                    <div class="users_inp_div">
                                        <input type="text" name="username" value="{{ old('username') }}"
                                        class="form-control @error('username') error-border @enderror" placeholder="" />
                                        @error('username')
                                            <div class="error-text">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <label class="form-label">{{__('label.username')}}</label>
                                </div>
                                

                            </div>

                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="first_name" class="form-control" placeholder=""
                                    value="{{ old('first_name') }}" />
                                <label class="form-label">{{__('label.name')}}</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="last_name" class="form-control" placeholder=""
                                    value="{{ old('last_name') }}" />
                                <label class="form-label">{{__('label.last-name')}}</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div>
                                <div class="form-floating">
                                    <div class="users_inp_div">
                                        <input type="password" name="password"
                                        class="form-control @error('password') error-border @enderror" placeholder="" />
                                        @error('password')
                                            <div class="error-text">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <label class="form-label">{{__('label.password')}}</label>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" name="confirm-password" class="form-control" placeholder="" />
                                <label class="form-label">{{__('label.confirm-password')}}</label>

                            </div>
                        </div>
                        <div class="col-12">
                            <div>
                                <div class="form-floating">
                                    <div class="users_inp_div">
                                        <select name="roles[]" class="form-select form-control @error('roles') error-border @enderror">
                                            <option selected disabled value="" hidden></option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}"
                                                    {{ $role == old('roles') ? 'selected' : '' }}>
                                                    {{ __("roles.$role") }}</option>
                                            @endforeach

                                        </select>

                                        @error('roles')
                                                <div class="error-text">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                    <label class="form-label my-classSelect">{{__('label.roles')}}</label>
                                </div>
                                

                            </div>
                        </div>

                        <div class="col-12 my-btn-class">
                            <button class="btn btn-primary" type="submit">
                                {{__('button.save')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
