@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="d-flex justify-content-between mb-4">
            <h2>File Upload</h2>

            <button type="button" class="btn btn-secondary">
                <a style="color:white" href="{{ route('show.allDetails', ['locale' => app()->getLocale()]) }}">Show All
                    Search</a>
            </button>
        </div>
        
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('upload.submit', ['locale' => app()->getLocale()]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button type="submit">Upload File</button>
        </form>

        @foreach ($cleanedFiles as $file)
            <a
                href="{{ route('file.details', ['locale' => app()->getLocale(), 'filename' => $file]) }}">{{ $file }}</a><br>
        @endforeach


    </div>
@endsection
