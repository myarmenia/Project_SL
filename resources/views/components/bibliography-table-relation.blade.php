@if (count($parentModel->$relation)>0)
<hr>
<span>{{__('content.'.$relation)}}</span>
@endif
<table class="table table-bordered" data-table-name="man">
    @if (count($parentModel->$relation)>0)
        <thead>
            <tr style="background-color:#c6d5ec; position: sticky;top: 0">
                <th scope="col">Id</th>
                <th scope="col">{{ __('table.name') }}</th>
                <th scope="col">{{ __('table.last_name') }}</th>
                <th scope="col">{{ __('table.patronymic') }}</th>
                <th scope="col">{{ __('table.birthday') }}</th>

                <th scope="col">{{ __('button.edit') }}</th>
                <th scope="col">{{ __('button.watch') }}</th>
                <th scope="col">{{ __('button.relations') }}</th>
            </tr>
        </thead>

    @endif

    <tbody>

        @foreach ($parentModel->$relation as $key => $data)
            @if($relation !== $disabledSecondRelation)
                @foreach ($data->$innerRelation as $item )
                    <tr class="start">

                        <td scope="row">{{ $item->id }}</td>
                        <td contenteditable="true" spellcheck="false">

                            {{ $item->firstName->first_name }}

                        </td>
                        <td contenteditable="true" spellcheck="false">
                            {{ $item->lastName->last_name }}
                        </td>
                        <td contenteditable="true" spellcheck="false">

                            {{ $item->middleName != null ? $item->middleName->middle_name : null }}

                        </td>
                        <td contenteditable="true" spellcheck="false">
                            {{ $item->birthday_str != null ? $item->birthday_str : null }}
                        </td>

                        <td scope="row" class="td-icon text-center">
                            <a href="{{ route('man.edit', $item->id) }}"> <i class="bi bi-pen"></i></a>
                        </td>
                        <td scope="row" class="td-icon text-center">
                            <i class="bi bi-folder2-open modalDoc" data-info="{{$item->id}}"></i>
                        </td>
                        <td scope="row" class="td-icon text-center">
                            <a target="blank">
                                <i class="bi bi-eye open-eye" data-id="{{ $item->id }}"></i>
                                <span></span>
                            </a>
                        </td>
                    </tr>

                @endforeach
            @else

                <tr class="start">
                  
                    <td scope="row">{{ $data->id }}</td>

                    <td contenteditable="true" spellcheck="false">

                        {{ $data->firstName->first_name }}

                    </td>
                    <td contenteditable="true" spellcheck="false">
                        {{ $data->lastName->last_name }}
                    </td>
                    <td contenteditable="true" spellcheck="false">

                        {{ $data->middleName != null ? $data->middleName->middle_name : null }}

                    </td>
                    <td contenteditable="true" spellcheck="false">
                        {{ $data->birthday_str != null ? $data->birthday_str : null }}
                    </td>

                    <td scope="row" class="td-icon text-center">
                        <a href="{{ route('man.edit', $data->id) }}"> <i class="bi bi-pen"></i></a>
                    </td>
                    <td scope="row" class="td-icon text-center">

                        <i class="bi bi-folder2-open modalDoc" data-info="{{$data->id}}"></i>
                    </td>
                    <td scope="row" class="td-icon text-center">

                        <a target="blank">
                            <i class="bi bi-eye open-eye" data-id="{{ $data->id }}"></i>
                            <span></span>
                        </a>
                    </td>
                </tr>

            @endif
        @endforeach

        </div>
    </tbody>
</table>
