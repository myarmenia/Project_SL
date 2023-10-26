<div class="tegs-div">
    @if (count($data[$relation]))
        @foreach ($data[$relation] as  $item)
            <div class="Myteg">
                <span class="">{{$item[$name]}}</span>
                <span class="delete-from-db check_tag"
                      data-value="{{$item[$name]}}"
                      data-delete-id="{{$item->id}}"
                      data-table="{{$relation}}"
                      data-model-id="{{$data->id}}"
                      data-parent-modal-name = "{{$modelName}}"
                     data-pivot-table="{{$relation}}"
                >X</span>
            </div>
        @endforeach
    @endif

</div>
