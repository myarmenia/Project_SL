@extends('layouts.auth-app')
@section('content')

    <x-breadcrumbs :title="__('pagetitle.edit-user')" :crumbs="[
    ['name' => __('pagetitle.users'),'route' => 'users.index', 'route_param' => ''],
    ]" :id="$user->id"/>

    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <form class="row g-3 needs-validation myclass" novalidate
                        action="{{ route('users.update', $user->id) }}" method="POST">
                        @method('PATCH')
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="username" value="{{ old('username') ?? $user->username }}"
                                    class="form-control @error('username') error-border @enderror" placeholder="" />
                                <label class="form-label">{{ __('label.username') }}</label>

                            </div>
                            @error('username')
                                <div class="error-text">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="first_name" class="form-control" placeholder=""
                                    value="{{ old('first_name') ?? $user->first_name }}" />
                                <label class="form-label">{{ __('label.name') }}</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="last_name" class="form-control" placeholder=""
                                    value="{{ old('last_name') ?? $user->last_name }}" />
                                <label class="form-label">{{ __('label.last-name') }}</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" name="password"
                                    class="form-control @error('password') error-border @enderror" placeholder="" />
                                <label class="form-label">{{ __('label.password') }}</label>


                            </div>
                            @error('password')
                                <div class="error-text">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" name="confirm-password" class="form-control" placeholder="" />
                                <label class="form-label">{{ __('label.confirm-password') }}</label>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <select name="roles[]" class="form-select @error('roles') error-border @enderror">
                                    <option selected disabled value="" hidden></option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ $role == $userRole ? 'selected' : '' }}>
                                            {{ __("roles.$role") }}</option>
                                    @endforeach

                                </select>
                                <label class="form-label my-classSelect">{{ __('pagetitle.roles') }}</label>

                            </div>
                            @error('roles')
                                <div class="error-text">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 my-btn-class">
                            <button class="btn btn-primary" type="submit">
                                {{ __('button.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
