@extends('layouts.auth-app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/translate/index.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            {{-- <h1>{{ __('sidebar.' . $page) }}</h1> --}}
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">
                        {{-- {{ __('sidebar.' . $page) }} --}}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->



    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <div class="add-translate-block">
                        <input type="text" name="content" placeholder="name" class="form-control create-translate-inp">
                        <select name="chapter" id="" class="form-select create-translate-select">
                            <option hidden>Ընտրել տիպը</option>
                            @foreach ($chapters as $chapter)
                                <option data-id = "{{ $chapter->id }}" value="{{ $chapter->id }}">{{ $chapter->content}}</option>
                            @endforeach
                        </select>

                        <button class="btn btn-primary translate-send-btn">Send</button>

                    </div>


                </div>
            </div>
        </div>
    </section>












    {{-- <form action="{{ route('translate') }}" method="post"> --}}
    {{-- @csrf --}}

    {{-- <input type="text" name="last_name" placeholder="last_name">
        <input type="text" name="family_name" placeholder="family_name"> --}}



    {{-- <select name="type">
            <option value="mard">mard</option>
            <option value="text">text</option>
        </select>
        male<input type="radio" name="gender" value="male>
        female<input type="radio" name="gender" value="female"> --}}

    {{-- </form> --}}







    {{-- @if (session('result')) --}}

    {{-- @php
            $result = session('result'); --}}
    {{-- // $lang = $result['lang']; --}}

    {{-- // $translations = $result['translations']; --}}
    {{-- @endphp --}}


    {{-- @if (session('type') != 'db')
            <table>
                <thead> --}}
    {{-- <th colspan="3" class="glxavor">original</th> --}}
    {{-- @foreach ($translations as $key => $item)
                        <th colspan="{{ count($item) }}" class="glxavor">{{ $key }}</th>
                    @endforeach --}}

    {{-- </thead>
                <thead> --}}
    {{-- <td>name</td>
                <td>last_name</td>
                <td>family_name</td> --}}

    {{-- @foreach ($result as $key => $item)
                        <th>{{ $key }}</th>
                    @endforeach
                </thead>
                <tr>
                    <form action="{{ route('system_learning') }}" method="post">
                        @csrf
                        @foreach ($result as $key => $item)
                            <td>
                                <input class="input" type="text"
                                    name="{{ $key }}" value="{{ $item }}">
                            </td>
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
    @endif --}}

@section('js-scripts')
    <script src='{{ asset('assets/js/translate/translate.js') }}'></script>
@endsection

@endsection
