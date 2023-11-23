<div class="pagetitle-wrapper">
    <div class="pagetitle">
        <h1>{{$title}}</h1>
        <nav>

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('pagetitle.main')}}</a></li>
                @foreach($crumbs as $crumb)
                    <li class="breadcrumb-item">
                        @if(isset($crumb['route']))
                        <a href="{{$crumb['route']}}">{{$crumb['name']}}</a>
                        @else
                            {{$crumb['name']}}
                        @endif
                    </li>
                @endforeach
                    <li class="breadcrumb-item active" data-model-id='{{$id}}'> {{$title}}@if($id) ID: {{$id}}@endif</li>
            </ol>
        </nav>
    </div>
</div>
