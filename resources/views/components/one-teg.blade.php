<div class="tegs-div">
    <div class="tegs-div-content">
        @if ($item->content !== null)

            <div class="Myteg">
                <span class="info-block" data-info = {{$inputValue}} data-bs-toggle="modal" data-bs-target="#additional_information">{{$inputValue}}</span>
                @if(isset($edit))
                <span class="edit-pen"><a href="#"><i class="bi bi-pen"></i></a></span>
                @endif
                @if(isset($delete))
                <span class="xMark delete-from-db check_tag">X</span>
                @endif
            </div>

        @endif
    </div>
</div>
