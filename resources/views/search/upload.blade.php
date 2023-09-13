@extends('layouts.app')
@section('content')
    {{-- <div class="row"> --}}
    {{-- <div class="d-flex justify-content-between mb-4">
            <h2>File Upload</h2>

            <button type="button" class="btn btn-secondary">
                <a style="color:white" href="{{ route('show.allDetails', ['locale' => app()->getLocale()]) }}">Show All
                    Search</a>
            </button>
        </div> --}}

    <div class="flex justify-between items-center">
        <h5 class="card-title">Table 1</h5>
        <a href="{{ route('show.allDetails', ['locale' => app()->getLocale()]) }}" class="btn btn-secondary h-fit w-fit">See
            All</a>
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

    <form action="{{ route('upload.submit', ['locale' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <span class="form-label">Upload Files</span>
        <div class="file-upload-container">
            <input type="file" data-href-type="" class="file-upload" data-render-type="none" multiple hidden
                name="file" />
            <label class="file-upload-btn btn btn-secondary h-fit w-fit">
                Բեռնել
            </label>
        </div>
    </form>

    @foreach ($cleanedFiles as $file)
        <a
            href="{{ route('file.details', ['locale' => app()->getLocale(), 'filename' => $file]) }}">{{ $file }}</a><br>
    @endforeach


    {{-- </div> --}}
@endsection
