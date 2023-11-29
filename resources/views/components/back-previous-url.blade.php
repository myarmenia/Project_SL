<div class="flex justify-content-end">
    @if($submit)
        <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-left"></i></button>
    @else

{{--        <a class="btn btn-primary"--}}
{{--           href="{{$url->previousParams['page'] ? route($url->previousParams['as'],$url->previousParams['page']) : route($url->previousParams['as']) }}">--}}
{{--            <i class="bi bi-arrow-left"></i>--}}
{{--        </a>--}}

        <a class="btn btn-primary"
           href="{{ $url && $url->previousParams && isset($url->previousParams['page']) ? route($url->previousParams['as'], $url->previousParams['page']) : (isset($url->previousParams['as']) ? route($url->previousParams['as']) : '#') }}">

           @if(isset($url->previousParams))
               href="{{$url->previousParams['page'] ? route( $url->previousParams['as'],$url->previousParams['page']) : route($url->previousParams['as']) }}"
            @else
                href="{{route($url)}}"
            @endif>

            <i class="bi bi-arrow-left"></i>
        </a>
    @endif
</div>
