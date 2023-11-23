@extends('roles.index')

@section('permissions-content')

    <div class="group-content">

        <div class="card show" data-target="1">
            <div class="card-body">
                <h5 class="card-title">Գործիքներ</h5>

                <!-- Bordered Table -->
                <form action="{{ route('roles.update', $role->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Անուն</th>
                                <th scope="col" class="td-xs">Կարդալ</th>
                                <th scope="col" class="td-xs">Ստեղծել</th>
                                <th scope="col" class="td-xs">փոփոխել</th>
                                <th scope="col" class="td-xs">Ջնջել</th>
                                <th scope="col" class="td-xs">Թույլատրել</th>
                                <th scope="col" class="td-xs">Նշել բոլորը</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $fildes = ['list', 'create', 'edit', 'delete', 'allow'];
                            @endphp

                            @foreach ($permissions as $key => $permission)
                                @php $arr = [] @endphp

                                <tr class="oneLine">
                                    <td data-attr="name"> {{ __("name.$key") }}</td>

                                    @foreach ($permission as $value)
                                        @php

                                            $attrs = explode('-', $value->name);
                                            $arr[$attrs[1]] = $value->id;
                                        @endphp
                                    @endforeach
                                    @foreach ($fildes as $item)
                                        <td data-attr="list">
                                            @if (isset($arr[$item]))
                                                <div class="form-check">
                                                    <input class="form-check-input trCheckItem" type="checkbox"
                                                        name="permission[]" value="{{ $arr[$item] }}"
                                                        {{ in_array($arr[$item], $rolePermissions) ? 'checked' : false }} />
                                                </div>
                                            @else
                                                <i class="bi bi-slash-circle"></i>
                                            @endif

                                        </td>
                                    @endforeach

                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input trAllcheck" type="checkbox" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="btn-wrapper">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{__('button.save')}}
                        </button>
                    </div>
                </form>
                <!-- End Bordered Table -->
            </div>
        </div>

    </div>
@endsection

