@extends('layouts.app')

@section('style')
    <style>
        table {
            width: 100%;
        }

        th,
        td {
            padding: 10px 20px;
            border: 1px solid black !important;
            text-transform: capitalize;
        }

        .glxavor {
            padding: 10px 0;
            text-align: center
        }

        .input {
            border: none
        }
    </style>
@endsection


@section('content')
    <form action="{{ route('translate') }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="name">
        <input type="text" name="last_name" placeholder="last_name">
        <input type="text" name="family_name" placeholder="family_name">
        {{-- <select name="type">
            <option value="mard">mard</option>
            <option value="text">text</option>
        </select>
        male<input type="radio" name="gender" value="male>
        female<input type="radio" name="gender" value="female"> --}}

        <button>Send</button>
    </form>


    @if (session('result'))

        @php
            $result = session('result');
            $lang = $result['lang'];

            $translations = $result['translations'];
        @endphp


        @if (session('type') != 'db')
            <table>
                <thead>
                    {{-- <th colspan="3" class="glxavor">original</th> --}}
                    @foreach ($translations as $key => $item)
                        <th colspan="{{ count($item) }}" class="glxavor">{{ $key }}</th>
                    @endforeach

                </thead>
                <thead>
                    {{-- <td>name</td>
                <td>last_name</td>
                <td>family_name</td> --}}
                    @foreach ($translations as $key => $item)
                        @foreach ($translations[$key] as $t_key => $t_item)
                            <th>{{ $t_key }}</th>
                        @endforeach
                    @endforeach
                </thead>
                <tr>
                    <form action="{{ route('system_learning') }}" method="post">
                        @csrf
                        @foreach ($translations as $key => $item)
                            @foreach ($translations[$key] as $t_key => $t_item)
                                <td>
                                    <input class="input" type="text"
                                        name="translate[{{ $key }}][{{ $t_key }}]"
                                        value="{{ $t_item }}">
                                    {{-- {{ $item }} --}}
                                </td>
                            @endforeach
                        @endforeach
                        <button>Send</button>
                    </form>
                </tr>
            </table>
        @else

            <table>
                <thead>

                </thead>
                <tr>

                </tr>
            </table>
        @endif
    @endif
@endsection
