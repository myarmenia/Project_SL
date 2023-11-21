<div class="pagetitle-wrapper">
    <div class="pagetitle">
        <h1>{{$title}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('pagetitle.main')}}</a></li>
                @foreach($crumbs as $crumb)
                    <li class="breadcrumb-item"><a href="{{$crumb['route']}}">{{$crumb['name']}}</a></li>
                @endforeach
                @if($id)
                    <li class="breadcrumb-item active" data-model-id='{{$id}}'> {{$title}} ID: {{$id}}</li>
                @endif
            </ol>
        </nav>
    </div>
</div>