<div class="tegs-div">
    {{-- {{dd($data[$relation])}} --}}
    <div class="tegs-div-content">
        @if (count($data[$relation]))
            @foreach ($data[$relation] as $item)
                <div class="Myteg">
                    <!-- <span class="">{{ $label ?? '' }}{{ $item[$name] }}</span> -->
                    <span class=""><a href="#">{{ $label ?? '' }}{{ $item[$name] }}</a></span>
                    @if(isset($edit))
                        <span class="edit-pen"><a href="#"><i class="bi bi-pen"></i></a></span>
                    @endif
                    @if(isset($delete))
                        <span class="xMark delete-from-db check_tag"
                              data-value="{{ $item[$name] }}"
                              data-delete-id="{{ $item->id }}"
                              data-table="{{ $relation }}"
                              data-model-id="{{ $data->id }}"
                              data-pivot-table="{{ $relation }}"
                              @if (isset($relationtype)) data-relation-type="{{ $relationtype }}" @endif>X
                            </span>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>
