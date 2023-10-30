@foreach($errors->all() as $error)
    <div>
        <p>
            {{$error}}
        </p>
    </div>
@endforeach
