@extends('roles.index')

@section('permissions-content')
    <div class="">
        <form novalidate class="card new-card " action="{{ route('roles.store') }}" method="post">
            @csrf

            <div class="card-body">
                <div class="card-title">
                    <div class="col-4">
                        <div class="form-floating">
                            <input type="text" id="inp" class="form-control" placeholder="" name="name"
                                required />
                            <label class="form-label">{{__('label.name')}}</label>
                            @error('name')
                                <div class="">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="form-check my-formCheck-class">
                            <input class="form-check-input" type="checkbox" id="checkAll" />
                            <label for="checkAll">{{__('label.mark-all')}}</label>
                        </div>
                    </div>
                </div>
                <!-- Bordered Table -->
                @error('permission')
                    <div class="">
                        {{ $message }}
                    </div>
                @enderror

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">{{__('table.name')}}</th>
                            <th scope="col" class="td-xs">{{__('table.read')}}</th>
                            <th scope="col" class="td-xs">{{__('table.create')}}</th>
                            <th scope="col" class="td-xs">{{__('table.edit')}}</th>
                            <th scope="col" class="td-xs">{{__('table.delete')}}</th>
                            <th scope="col" class="td-xs">{{__('table.allow')}}</th>
                            <th scope="col" class="td-xs">{{__('table.mark-all')}}</th>
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
                                                    name="permission[]" value="{{ $arr[$item] }}" />
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
                <!-- End Bordered Table -->
                <div class="btn-wrapper">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{__('button.save')}}
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection
