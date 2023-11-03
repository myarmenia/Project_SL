<div class="tegs-div">

    <div class="tegs-div-content">
        @if (count($data[$relation]))
            @foreach ($data[$relation] as $item)


                <div class="Myteg">
                    <span class="">{{ $label ?? '' }}{{ $item[$name] }}</span>
                    <span class="delete-from-db check_tag"
                        data-value="{{ $item[$name] }}"
                        data-delete-id="{{ $item->id }}"
                        data-table="{{ $relation }}"
                        data-model-id="{{ $data->id }}"
                        data-pivot-table="{{ $relation }}"
                        @if (isset($relationtype)) data-relation-type="{{ $relationtype }}" @endif>X</span>
                </div>
            @endforeach
        @endif
    </div>
</div>
