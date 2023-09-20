{{-- @extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index', ['locale' => app()->getLocale()]) }}"> Back</a>
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


{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permission:</strong>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}


@endsection --}}


@extends('roles.index')

@section('permissions-content')
    <div class="group-content">
        <form novalidate class="card new-card needs-validation">
            <div class="card-body">
                <h5 class="card-title">
                    <div class="col-4">
                        <div class="form-floating">
                            <input type="text" id="inp" class="form-control" placeholder="" required />
                            <label class="form-label">Անուն</label>
                        </div>
                        <div class="form-check my-formCheck-class">
                            <input class="form-check-input" type="checkbox" id="checkAll" />
                            <label for="checkAll">Նշել Բոլորը</label>
                        </div>
                    </div>
                </h5>
                <!-- Bordered Table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="numbering" scope="col">#</th>
                            <th scope="col">Անուն</th>
                            <th scope="col" class="td-xs">Կարդալ</th>
                            <th scope="col" class="td-xs">փոփոխել</th>
                            <th scope="col" class="td-xs">Ջնջել</th>
                            <th scope="col" class="td-xs">Ստեղծել</th>
                            <th scope="col" class="td-xs">Թույլատրել</th>
                            <th scope="col" class="td-xs">Նշել բոլորը</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="oneLine">
                            <th class="numbering" scope="row">2</th>
                            <td>Որոնում</td>
                            <td>
                                <i class="bi bi-slash-circle"></i>
                            </td>
                            <td>
                                <i class="bi bi-slash-circle"></i>
                            </td>
                            <td>
                                <i class="bi bi-slash-circle"></i>
                            </td>
                            <td>
                                <i class="bi bi-slash-circle"></i>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input trCheckItem" type="checkbox" />
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input trAllcheck" type="checkbox" />
                                </div>
                            </td>
                        </tr>

                        <tr class="oneLine">
                            <th class="numbering" scope="row">2</th>
                            <td>Անձեր</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input trCheckItem" type="checkbox" />
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input trCheckItem" type="checkbox" />
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input trCheckItem" type="checkbox" />
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input trCheckItem" type="checkbox" />
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <i class="bi bi-slash-circle"></i>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input trAllcheck" type="checkbox" />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- End Bordered Table -->
                <div class="btn-wrapper">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Ուղարկել
                    </button>
                </div>
            </div>
        </form>

{{-- ======================================= --}}
    </div>
@endsection
