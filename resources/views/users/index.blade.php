@extends('layouts.app')


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="flex justify-between items-center">
        <h5 class="card-title">{{ __('messages.headerUser') }}</h5>
        <a href="{{ route('users.create', ['locale' => app()->getLocale()]) }}" type="button"
            class="btn btn-secondary h-fit">Ավելացնել</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col" class="td-xs">Show</th>
                <th scope="col" class="td-xs">Edit</th>
                <th scope="col" class="td-xs">Delete</th>
            </tr>
        </thead>
        <tbody>
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
                        <a class="btn btn-info"
                            href="{{ route('users.show', ['user' => $user->id, 'locale' => app()->getLocale()]) }}">Show</a>


                    </td>
                    <td>
                        <a class="btn btn-primary"
                            href="{{ route('users.edit', ['user' => $user->id, 'locale' => app()->getLocale()]) }}">Edit</a>
                    </td>
                    <td>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['users.destroy', ['user' => $user->id, 'locale' => app()->getLocale()]],
                            'style' => 'display:inline',
                        ]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {!! $data->render() !!}
@endsection
