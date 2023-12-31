@if (count($parentModel->$relation) > 0)

    {{-- <hr style="border:5px solid">
    <span>{{__('content.'.$relation)}}</span>
    <hr> --}}
    @if ($relation !== $disabledSecondRelation)
        @if ($relation !== 'controll')
            {{-- for head title to write one time  --}}
            @foreach ($parentModel->$relation as $key => $data)
                @if ($key == 0 && count($data->$innerRelation) > 0)
                    <hr style="border:5px solid">
                    <a href="{{ route('open.page.bibliography', [$relation, $parentModel->id]) }}">
                        <span class="btn btn-primary" style="max-width: 100%">{{ __('content.' . $relation) }}</span>
                    </a>
                    <hr>
                    @php
                        break;
                    @endphp
                @endif
            @endforeach
            {{--  --}}

            @foreach ($parentModel->$relation as $key => $data)
                @if (count($data->$innerRelation) > 0)
                    {{-- <span>{{ __('content.' . $relation) }} id - {{ $data->id }}</span> --}}
                    <div class="table_div" style="height: 350px">
                        <a style="color: blue ;" href="{{ route($relation . '.edit', $data->id) }}" class="relation-table-id"
                            data-table-id = "{{ $data->id }}">{{ __('content.' . $relation) }} id -
                            {{ $data->id }} </a>
                        <table class="table table-bordered person_table" data-table-name="man"
                            data-table-id = "{{ $data->id }}" data-filter-table-name="{{ $relation }}"
                            data-section-name='bibliography' style="margin-top:20px ">
                            <thead>
                                <tr style="background-color:#c6d5ec; position: sticky; top:0;">
                                    <th class="filter-th" scope="col" data-type="filter-id"><i
                                            class="bi bi-funnel-fill" aria-hidden="true" data-field-name="id"></i> Id
                                    </th>
                                    
                                    <th class="filter-th" scope="col" data-type="standart-complex">
                                        {{ __('table.name') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="first_name"></i></th>
                                    <th class="filter-th" scope="col" data-type="standart-complex">
                                        {{ __('table.last_name') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="last_name"></i></th>
                                    <th class="filter-th" scope="col" data-type="standart-complex">
                                        {{ __('table.patronymic') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="middle_name"></th>
                                    <th class="filter-th" scope="col" data-type="standart-complex">
                                        {{ __('table.birthday') }} <i class="bi bi-funnel-fill" aria-hidden="true"
                                            data-field-name="birthday_str"></i></th>
                                    <th class="filter-th" scope="col">{{ __('button.edit') }}</th>
                                    <th class="filter-th" scope="col">{{ __('button.watch') }}</th>
                                    <th class="filter-th" scope="col">{{ __('button.relations') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data->$innerRelation as $item)
                                    <tr class="start">
                                        <td scope="row">{{ $item->id }}</td>
                                        <td>

                                            @if (count($item->first_name) > 0)
                                                @php
                                                    $content_first_name = '';
                                                @endphp
                                                @foreach ($item->first_name as $n => $name)
                                                    @if ($n > 0)
                                                        @php $content_first_name.=' '; @endphp
                                                    @endif
                                                    @php $content_first_name .= $name->first_name; @endphp
                                                @endforeach
                                                {{ $content_first_name }}
                                            @endif

                                        </td>
                                        <td>
                                            @if (count($item->last_name))
                                                @php
                                                    $content_last_name = '';
                                                @endphp
                                                @foreach ($item->last_name as $n => $name)
                                                    @if ($n > 0)
                                                        @php $content_last_name .= ' ' @endphp
                                                    @endif
                                                    @php  $content_last_name .= $name->last_name; @endphp
                                                @endforeach
                                                {{ $content_last_name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (count($item->middle_name))
                                                @php
                                                    $content_middle_name = '';
                                                @endphp
                                                @foreach ($item->middle_name as $n => $name)
                                                    @if ($n > 0)
                                                        @php $content_middle_name .= ' ' @endphp
                                                    @endif
                                                    @php  $content_middle_name .= $name->middle_name; @endphp
                                                @endforeach
                                                {{ $content_middle_name }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $item->birthday_str != null ? $item->birthday_str : null }}
                                        </td>

                                        <td scope="row" class="td-icon text-center">
                                            <a href="{{ route('man.edit', $item->id) }}"> <i class="bi bi-pen"></i></a>
                                        </td>
                                        <td scope="row" class="td-icon text-center">
                                            <i class="bi bi-folder2-open modalDoc" data-info="{{ $item->id }}"></i>
                                        </td>
                                        <td scope="row" class="td-icon text-center">
                                            <a target="blank">
                                                <i class="bi bi-eye open-eye" data-id="{{ $item->id }}"></i>
                                                <span></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endforeach

        @endif
    @else
        <hr style="border:5px solid">
        <span>{{ __('content.' . $relation) }}</span>
        <hr>
        <div class="table_div" style="height: 350px">
            <span class ='relation-table-id' data-table-id="{{$parentModel->id}}"></span>
            <table class="table table-bordered person_table man-table"  data-table-name="{{ $relation }}"
                data-section-name='bibliography'>
                <thead>
                    <tr style="background-color:#c6d5ec; position: sticky;top: 0;">
                        <th class="filter-th" scope="col" data-type="filter-id"><i class="bi bi-funnel-fill"
                                aria-hidden="true" data-field-name="id"></i> Id</th>
                        <th class="filter-th" scope="col" data-type="standart-complex"> {{ __('table.name') }} <i
                                class="bi bi-funnel-fill" aria-hidden="true" data-field-name="first_name"></i></th>
                        <th class="filter-th" scope="col" data-type="standart-complex">{{ __('table.last_name') }}
                            <i class="bi bi-funnel-fill" aria-hidden="true" data-field-name="last_name"></i>
                        </th>
                        <th class="filter-th" scope="col" data-type="standart-complex">
                            {{ __('table.patronymic') }}<i class="bi bi-funnel-fill" aria-hidden="true"
                                data-field-name="middle_name"></th>
                        <th class="filter-th" scope="col" data-type="filter-complex">{{ __('table.birthday') }}
                            <i class="bi bi-funnel-fill" aria-hidden="true" data-field-name="birthday_str"></i></th>
                        <th class="filter-th" scope="col">{{ __('button.edit') }}</th>
                        <th class="filter-th" scope="col">{{ __('button.watch') }}</th>
                        <th class="filter-th" scope="col">{{ __('button.relations') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parentModel->$relation as $key => $data)
                        <tr class="start">

                            <td scope="row">{{ $data->id }}</td>

                            <td>

                                @if (count($data->first_name) > 0)
                                    @php
                                        $content_first_name = '';
                                    @endphp
                                    @foreach ($data->first_name as $n => $name)
                                        @if ($n > 0)
                                            @php
                                                $content_first_name .= ' ';
                                            @endphp
                                        @endif
                                        @php $content_first_name .=$name->first_name;   @endphp
                                    @endforeach
                                    {{ $content_first_name }}
                                @endif
                            </td>
                            <td>
                                @if (count($data->last_name))
                                    @php
                                        $content_last_name = '';
                                    @endphp
                                    @foreach ($data->last_name as $n => $name)
                                        @if ($n > 0)
                                            @php $content_last_name .= ' ' @endphp
                                        @endif
                                        @php  $content_last_name .= $name->last_name; @endphp
                                    @endforeach
                                    {{ $content_last_name }}
                                @endif
                            </td>
                            <td >
                                @if (count($data->middle_name))
                                    @php
                                        $content_middle_name = '';
                                    @endphp
                                    @foreach ($data->middle_name as $n => $name)
                                        @if ($n > 0)
                                            @php $content_middle_name .= ' ' @endphp
                                        @endif
                                        @php  $content_middle_name .= $name->middle_name; @endphp
                                    @endforeach
                                    {{ $content_middle_name }}
                                @endif
                            </td>
                            <td >
                                {{ $data->birthday_str != null ? $data->birthday_str : null }}
                            </td>

                            <td scope="row" class="td-icon text-center">
                                <a href="{{ route('man.edit', $data->id) }}"> <i class="bi bi-pen"></i></a>
                            </td>
                            <td scope="row" class="td-icon text-center">

                                <i class="bi bi-folder2-open modalDoc" data-info="{{ $data->id }}"></i>
                            </td>
                            <td scope="row" class="td-icon text-center">

                                <a target="blank">
                                    <i class="bi bi-eye open-eye" data-id="{{ $data->id }}"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endif
