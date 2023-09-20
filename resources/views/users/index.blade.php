@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')
    {{-- <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> {{ __('messages.headerUser') }} </h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create', ['locale' => app()->getLocale()]) }}"> Create New User</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif --}}


    {{-- <table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if (!empty($user->getRoleNames()))
        @foreach ($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
       <a class="btn btn-info" href="{{ route('users.show', ['user' => $user->id, 'locale' => app()->getLocale()]) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('users.edit', ['user' => $user->id, 'locale' => app()->getLocale()]) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy',  ['user' => $user->id, 'locale' => app()->getLocale()]],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table> --}}


    {{-- {!! $data->render() !!} --}}
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Գործածողների ցուցակ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">
                        Տվյալների մուտքագրում ֆայլերի միջոցով
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- List of users -->
    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/"
                        data-status-url="bbb/status/">
                        <thead>
                            <tr>
                                <th>Id <i class="fa fa-filter" aria-hidden="true">132</i></th>
                                <th>
                                    Գործածողների անուն
                                    <i class="fa fa-filter" aria-hidden="true"></i>
                                </th>
                                <th>
                                    Անուն <i class="fa fa-filter" aria-hidden="true"></i>
                                </th>
                                <th>
                                    Ազգանուն<i class="fa fa-filter" aria-hidden="true"></i>
                                </th>
                                <th>
                                    Տարատեսակ<i class="fa fa-filter" aria-hidden="true"></i>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <!-- search block -->
                            <div id="searchBlock">
                                <p>Փնտրել նաև</p>
                                <select id="searchBlock_section">
                                    <option>Սկսվում է</option>
                                    <option>Պարունակում է</option>
                                </select>
                                <div>
                                    <input type="text" placeholder="search" id="searchBlock_input" />
                                </div>
                                <div class="button_div">
                                    <button class="serch-button">Փնտրել</button>
                                    <button class="delButton">Մաքրել</button>
                                </div>
                            </div>
                            <!-- search block  Id-->
                            <div id="searchBlock" class="search_id_block">
                                <p>Փնտրել նաև</p>
                                <select id="searchBlock_section">
                                    <option>Հավասար է</option>
                                    <option>Հավասար չէ</option>
                                    <option>Մեծ է</option>
                                    <option>Մեծ է կամ հավասար</option>
                                    <option>Փոքր է</option>
                                    <option>Փոքր է կամ հավասար</option>
                                </select>
                                <div>
                                    <input type="number" id="searchBlock_input" min="0" />
                                </div>
                                <div class="button_div">
                                    <button class="serch-button">Փնտրել</button>
                                    <button class="delButton">Մաքրել</button>
                                </div>
                            </div>
                        </thead>
                        <tbody>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a href="#"><i class="bi bi-pencil-square"></i></a></td>
                                <td><button class="btn_close_modal" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="1"><i class="bi bi-trash3"></i></button></td>
                                <td><input type="range" value="0" min="0" max="1" class="rangeInput"
                                        data-bs-toggle="modal" data-bs-target="#avtiveModal" data-id="1" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a href="#"><i class="bi bi-pencil-square"></i></a></td>
                                <td><button class="btn_close_modal" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="2"><i class="bi bi-trash3"></i></button></td>
                                <td><input type="range" value="0" min="0" max="1" class="rangeInput"
                                        data-bs-toggle="modal" data-bs-target="#avtiveModal" data-id='2' /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a href="#"><i class="bi bi-pencil-square"></i></a></td>
                                <td><button class="btn_close_modal" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="3"><i class="bi bi-trash3"></i></button></td>
                                <td><input type="range" value="0" min="0" max="1" class="rangeInput"
                                        data-bs-toggle="modal" data-bs-target="#avtiveModal" data-id="3" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="paginaton_block">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

@section('js-scripts')
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
@endsection

@endsection
