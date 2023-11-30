@extends('layouts.auth-app')
@section('style')
    <link href="{{ asset('assets/css/roles/style.css') }}" rel="stylesheet" />
@endsection
@section('content')

    @if(Request::segment(4) === 'edit')
        <x-breadcrumbs :title="__('pagetitle.role')" :crumbs="[['name' => __('pagetitle.roles'), 'route' => 'roles.edit', 'route_param' => $role->id]]" :id="$role->id"/>
    @elseif(Request::segment(3) === 'create')
        <x-breadcrumbs :title="__('pagetitle.create')" :crumbs="[
        ['name' => __('pagetitle.roles'),'route' => 'roles.index', 'route_param' => ''],

        ]"/>
    @else
        <x-breadcrumbs :title="__('pagetitle.roles')" />
    @endif
    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <h5 class="card-title">{{ __('title.role-list')}}</h5>

                        <a href="{{ route('roles.create', ['locale' => app()->getLocale()]) }}" id="add-new-btn"
                            type="button" class="btn btn-secondary h-fit">
                            {{__('button.create')}}
                        </a>

                    </div>

                    <div class="d-flex flex-row flex-wrap gap-3" id="groups">
                        @foreach ($roles as $key => $item)
                            <div class="group position-relative">
                                <a href="{{ route('roles.edit', ['role' => $item->id, 'locale' => app()->getLocale()]) }}"
                                    data-btn="1"
                                    class="btn {{ isset($role) && $item->id == $role->id ? 'active' : '' }} btn-light mb-2 text-justify">
                                    {{ __("roles.$item->name") }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @yield('permissions-content')

        </div>
    </section>

@section('js-scripts')
    <script src="{{ asset('assets/js/roles/script.js') }}"></script>
    <script>
        const searchParams = new URLSearchParams(window.location.search);
        console.log(searchParams.get('addres')); // true

    </script>
@endsection
@endsection
