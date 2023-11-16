<div class="tegs-div">

    @if ($item)


        <div class="Myteg">
            <input hidden  value="{{$inputValue}}">
            <span class="">{{$inputValue}}</span>
            @if(isset($edit))
             <span class="edit-pen"><a href="#"><i class="bi bi-pen"></i></a></span>
            @endif
            @if(isset($delete))
            <span class=" xMark delete-from-db check_tag">X</span>
            @endif
        </div>

    @endif
</div>

