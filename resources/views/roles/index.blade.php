@extends('layouts.auth-app')
@section('style')
    <link href="{{ asset('assets/css/roles/style.css') }}" rel="stylesheet" />

@endsection
@section('content')
    {{-- <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Ստեղծել նոր Օգտատեր</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> {{ __('messages.headerRole') }} </h2>
            </div>
            <div class="pull-right">
                @can('role-create')
                    <a class="btn btn-success" href="{{ route('roles.create', app()->getLocale()) }}"> Create New Role</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info"
                        href="{{ route('roles.show', ['role' => $role->id, 'locale' => app()->getLocale()]) }}">Show</a>
                    @can('role-edit')
                        <a class="btn btn-primary"
                            href="{{ route('roles.edit', ['role' => $role->id, 'locale' => app()->getLocale()]) }}">Edit</a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['roles.destroy', ['role' => $role->id, 'locale' => app()->getLocale()]],
                            'style' => 'display:inline',
                        ]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>


    {!! $roles->render() !!} --}}

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Դերեր</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <h5 class="card-title">Առկա Դերերի Ցանկեր</h5>

                        <button id="add-new-btn" type="button" class="btn btn-secondary h-fit">
                            Ավելացնել
                        </button>
                    </div>

                    <div class="d-flex flex-row flex-wrap gap-3" id="groups">
                        @foreach ($roles as $key => $role)
                            <div class="group position-relative">
                                <a href="{{ route('roles.edit', ['role' => $role->id, 'locale' => app()->getLocale()]) }}"
                                    data-btn="1" class="btn active btn-light mb-2 text-justify">
                                    {{ $role->name }}
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
@endsection
@endsection
