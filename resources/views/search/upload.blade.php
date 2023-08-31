

    <h2>File Upload</h2>


    <form action="{{ route('upload.submit', ['locale' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Upload File</button>
    </form>

    @foreach ($cleanedFiles as $file)
        <a  href="{{ route('file.details', ['locale' => 'am', 'filename' => $file]) }}">{{ $file }}</a><br>
    @endforeach

