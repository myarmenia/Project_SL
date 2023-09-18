@extends('layouts.app')
@section('content')
    <div class ="row">
        <form action="{{ route('table-content.store', ['locale' => app()->getLocale()]) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".doc, .docx,">
            <button type="submit">Upload File</button>
            <div class ="row my-3">
                <label><input type = "text" value = "" name = "column_name[number]" /><input type="checkbox" class="m-2" />number</label>
                <label><input type = "text" value = "" name = "column_name[first_name]"/><input type="checkbox" class="m-2"/>first name </label>
                <label><input type = "text" value = "" name = "column_name[last_name]"/><input type="checkbox" class="m-2"/>last name </label>
                <label><input type = "text" value = "" name = "column_name[middle_name]"/><input type="checkbox" class="m-2"/>middle name </label>
                <label><input type = "text" value = "" name = "column_name[birthday]"/><input type="checkbox" class="m-2"/>birthday</label>
                <label><input type = "text" value = "" name = "column_name[address]"/><input type="checkbox" class="m-2"/>address</label>
            </div>
        </form>

    </div>

@endsection
