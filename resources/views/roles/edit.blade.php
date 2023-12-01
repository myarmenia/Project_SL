@extends('roles.index')

@section('permissions-content')

    <div class="group-content">

        <div class="card show" data-target="1">

            <div class="card-body">
                <x-back-previous-url />
                <h5 class="card-title">{{ __("table.tools") }}</h5>

                <!-- Bordered Table -->
                <form action="{{ route('roles.update', $role->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th scope="col">{{ __("table.name") }}</th>
                                <th scope="col" class="td-xs">{{ __("table.read") }}</th>
                                <th scope="col" class="td-xs">{{ __("table.create") }}</th>
                                <th scope="col" class="td-xs">{{ __("table.edit") }}</th>
                                <th scope="col" class="td-xs">{{ __("table.delete") }}</th>
                                <th scope="col" class="td-xs">{{ __("table.allow") }}</th>
                                <th scope="col" class="td-xs">{{ __("table.mark-all") }}</th>
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

