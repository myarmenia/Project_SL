@if(count($errors->all()))
    @foreach($errors->all() as $error)
        <div class="alert alert-danger mt-2" role="alert">
            {{$error}}
        </div>
    @endforeach
@endif
