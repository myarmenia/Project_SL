
@if (count($parentModel->$relation)>0)
    <hr >
    <span>{{__('content.'.$relation)}}</span>
    <hr>
    <table class="table table-bordered" data-table-name="man">
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
        <tbody>

            @foreach ($parentModel->$relation as $key => $data)
            <tr class="start">

                <td scope="row">{{ $data->id }}</td>

                <td contenteditable="true" spellcheck="false">

                    @if (count($data->first_name)>0)
                        @php
                            $content_first_name = '';
                        @endphp
                        @foreach ($data->first_name as  $n=>$name )
                            @if($n>0)
                                @php
                                    $content_first_name .= " ";
                                @endphp
                            @endif
                            @php $content_first_name .=$name->first_name;   @endphp
                        @endforeach
                        {{$content_first_name}}
                    @endif
                </td>
                <td contenteditable="true" spellcheck="false">
                    @if (count($data->last_name))
                        @php
                            $content_last_name = '';
                        @endphp
                        @foreach ($data->last_name as $n=>$name )
                            @if ($n>0)
                                @php $content_last_name .= ' ' @endphp
                            @endif
                            @php  $content_last_name .= $name->last_name; @endphp

                        @endforeach
                        {{$content_last_name}}
                    @endif
                </td>
                <td contenteditable="true" spellcheck="false">
                    @if (count($data->middle_name))
                        @php
                            $content_middle_name = '';
                        @endphp
                        @foreach ($data->middle_name as $n=>$name )
                            @if ($n>0)
                                @php $content_middle_name .= ' ' @endphp
                            @endif
                            @php  $content_middle_name .= $name->middle_name; @endphp
                        @endforeach
                        {{$content_middle_name}}

                    @endif
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
            @endforeach
        </tbody>
        <tbody>
    </table>
@endif
