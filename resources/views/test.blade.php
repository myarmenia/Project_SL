<form action="{{ route('content.tag.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="content"><br>
    <input type="text" name="tag"><br>
    <p>

    </p>
    <button type="submit" class="pointer">Upload</button>
</form>
