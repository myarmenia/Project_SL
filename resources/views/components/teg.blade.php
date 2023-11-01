<div class="tegs-div">
    @if ($item)
            <div class="Myteg">
                <input hidden name="{{$inputName}}" value="{{$item['id']}}">
                <span class="">{{$item[$name].' : '.$item['id'] }}</span>
                <span class="delete-from-db check_tag">X</span>
            </div>
    @endif
</div>
