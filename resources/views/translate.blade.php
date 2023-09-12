@extends('layouts.app')


@section('content')
    <form action="{{ route('translate') }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="name">
        <input type="text" name="last_name" placeholder="last_name">
        <input type="text" name="family_name" placeholder="family_name">
        <button>Send</button>
    </form>


    @if (session('result'))
        @php
            $result = session('result');

    dd($result);

            $en = $result['en'];
            $ru = $result['ru'];
            $hy = $result['hy'];
        @endphp

        {{ $en . ' ---- ' . $ru . ' ------ ' . $hy }}

    @endif
@endsection
