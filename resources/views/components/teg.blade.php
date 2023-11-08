<div class="tegs-div">
    @if ($item)
            <div class="Myteg">
                <input hidden name="{{$inputName}}" value="{{$item['id']}}">
                <span class="">{{ $label.' : '.$item['id'] ??  $item[$name].' : '.$item['id'] }}</span>
                <span class="edit-pen"><a href="#"><i class="bi bi-pen"></i></a></span>
                <span class=" xMark delete-from-db check_tag">X</span>
            </div>
    @endif
</div>

