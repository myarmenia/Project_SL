<div class="tegs-div">
    <div class="tegs-div-content">
        @if ($item)
            <div class="Myteg">
                <input hidden name="{{$inputName}}" value="{{$item['id']}}">
                <span class="">{{$label}}</span>
                @if(isset($edit))
                    <span class="edit-pen"><a href="#"><i class="bi bi-pen"></i></a></span>
                @endif
                @if(isset($delete))
                    @if(isset($redirect))
                        <a class="xMark" href="{{route($redirect['route'], ['model' => $redirect['model'], 'id'=> $redirect['id'],'redirect'=>$redirect['redirect']])}}">X</a>
                    @else
                        <span class=" xMark delete-from-db check_tag">X</span>
                    @endif
                @endif
            </div>
        @endif
    </div>
</div>
