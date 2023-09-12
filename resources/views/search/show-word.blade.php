
@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end">
        <input type="text" class="word-input" >
    </div>
    <div>
        <pre class="word-content">
            {!! $implodeArray !!}
        </pre>    

    </div>
@endsection

