<div>
    @if($submit)
        
    @else
        <a href="{{$url->previousParams['page'] ? route($url->previousParams['as'],$url->previousParams['page']) : route($url->previousParams['as']) }}">x</a>
    @endif
</div>
