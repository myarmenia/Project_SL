{{-- @extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index', ['locale' => app()->getLocale()]) }}"> Back</a>
        </div>
    </div>
</div>


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



{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

@endsection --}}


@extends('layouts.auth_app')
@section('content')

        <div class="pagetitle-wrapper">
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
        <!-- End Page Title -->

        <section class="section">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-3"></div>

                        <form class="row g-3 needs-validation myclass" novalidate>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" required placeholder="" />
                                    <label class="form-label">Օգտագործողի անունը</label>
                                    <div class="invalid-feedback">
                                        Խնդրում եմ, մուտքագրեք օգտագործողի անունը:
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" required placeholder="" />
                                    <label class="form-label">Քո էլէկտրոնային փոստը</label>
                                    <div class="invalid-feedback">
                                        Խնդրում ենք մուտքագրել գործող էլեկտրոնային հասցե!
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" required placeholder="" />
                                    <label class="form-label">Անուն</label>

                                    <div class="invalid-feedback">
                                        Խնդրում ենք ընտրել ձեր անուն:
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" placeholder="" />
                                    <label class="form-label">Ազգանուն</label>
                                    <div class="invalid-feedback">
                                        Խնդրում եմ, մուտքագրեք ձեր Ազգանունը:
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" required placeholder="" />
                                    <label class="form-label">Գաղտնաբառ</label>

                                    <div class="invalid-feedback">
                                        Խնդրում ենք մուտքագրել ձեր գաղտնաբառը:
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" required placeholder="" />
                                    <label class="form-label">Կրկնել գաղտնաբառ</label>

                                    <div class="invalid-feedback">
                                        Խնդրում ենք մուտքագրել ձեր գաղտնաբառը:
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <select name="" class="form-select">
                                        <option selected disabled value="" hidden></option>
                                        <option value="1">Մոդերատր</option>
                                        <option value="1">Ադմինիստրատր</option>
                                    </select>
                                    <label class="form-label">Դերեր</label>
                                    <div class="invalid-feedback">Խնդրում ենք ընտրել նշվածներից մեկը</div>
                                </div>
                            </div>

                            <div class="col-12 my-btn-class">
                                <button class="btn btn-primary" type="submit">
                                    Գրանցվել
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
@endsection
