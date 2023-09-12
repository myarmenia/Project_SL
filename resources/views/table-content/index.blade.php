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
                {{-- <label><input type="text" value="" name="number" /><input type="checkbox" />number</label> --}}
                <label><input type="text" value="" name="first_name"/><input type="checkbox" class="m-2"/>first name 1</label>
                <label><input type="text" value="" name="last_name"/><input type="checkbox" class="m-2"/>last name 2</label>
                <label><input type="text" value="" name="middle_name"/><input type="checkbox" class="m-2"/>middle name 3</label>
                <label><input type="text" value="" name="birthday"/><input type="checkbox" class="m-2"/>birthday</label>
            </div>
        </form>
    </div>

@endsection
