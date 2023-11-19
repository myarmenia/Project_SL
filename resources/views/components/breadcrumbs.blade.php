<div class="pagetitle-wrapper">
    <div class="pagetitle">
        <h1>{{$title}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('pagetitle.main')}}</a></li>
                @foreach($crumbs as $crumb)
                    <li class="breadcrumb-item active"><a href="{{route($crumb['route'],$crumb['route_param'] ?? 'home')}}"> {{$crumb['name']}}  </a></li>
                @endforeach
                @if($id)
                    <li class="breadcrumb-item active model-id" data-model-id='{{$id}}'><b>ID: {{$id}}</b>
                @endif
            </ol>
        </nav>
    </div>
</div>
