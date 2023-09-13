@extends('layouts.app')


@section('content')
    {{-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index', ['locale' => app()->getLocale()]) }}"> Back</a>
            </div>
        </div>
    </div> --}}

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div
    class="d-flex justify-content-between align-items-center my-3"
  ></div>



    {!! Form::open([
        'route' => 'users.store',
        'method' => 'POST',
        'novalidate' => '',
        'class' => 'row g-3 needs-validation',
    ]) !!}
    {{-- <div class="row g-3 needs-validation" novalidate> --}}
    <div class="col-12">
        <div class="form-floating">
            {!! Form::text('name', null, ['placeholder' => '', 'class' => 'form-control']) !!}
            <label class="form-label">Name</label>
            <div class="invalid-feedback">
                Խնդրում եմ, մուտքագրեք ձեր անունը:
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
            <label class="form-label">Email</label>
            <div class="invalid-feedback">
                Խնդրում ենք մուտքագրել գործող էլեկտրոնային հասցե!
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-floating">
            {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
            <label class="form-label">Password</label>
            <div class="invalid-feedback">
                Խնդրում ենք ընտրել օգտվողի անուն:
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
            <label class="form-label">Confirm Password</label>
            <div class="invalid-feedback">
                Խնդրում ենք մուտքագրել ձեր գաղտնաբառը:
            </div>
        </div>
    </div>

    {{-- {!! Form::select('roles[]', $roles, [], ['class' => 'form-select', 'multiple']) !!} --}}


    <div class="col-12">
        <div class="form-floating">
            <select class="form-select" name="roles[]">
                <option selected disabled value="" hidden></option>
                @foreach ($roles as $role)
                    <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
            </select>
            <label class="form-label">Role</label>
            <div class="invalid-feedback">Please choose one!</div>
        </div>
        {{-- {!! Form::select('roles[]', $data, [], ['class' => 'form-select',:"name"=> "k1[0]" 'multiple']) !!} --}}

    </div>

    <div class="col-12">
        <button class="btn btn-primary" type="submit">
            Գրանցվել
        </button>
    </div>

    {{-- ##################################################################### --}}
    {{-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div> --}}
    {{-- </div> --}}

    {!! Form::close() !!}

@endsection
