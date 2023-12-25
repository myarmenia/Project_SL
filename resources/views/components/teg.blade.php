<div class="tegs-div">
    <div class="tegs-div-content">
        @if ($item &&( $item->$relation || $inputName) || $item && $relations)
            <div class="Myteg">
                @if($inputName)
                    {{ $item->label }}
                    <input hidden name="{{$inputName}}" value="{{$item['id']}}">
                @endif
                @if($item->$relation || $relations)
                    <span  class="open-relation-field" @if($related) data-table-name="{{$item->curentModel ?? $tableName }}"  data-id="{{ $item->curentId ?? $item->$relation?->id }}" @endif>
                        {{ $item->label }}
                     </span>
                     @if($edit)
                        <span class="edit-pen"><a href="{{route($edit['page'], array_merge($edit,[$item->$relation?->id]))}}">
                                <i class="bi bi-pen"></i></a>
                        </span>
                     @endif
                @endif
                @if($delete)
                    @if($redirect)
                        <a class="xMark"  href="{{route($redirect['route'], ['model' => $redirect['model'],'id'=> $redirect['id'],'redirect'=>$redirect['redirect']])}}">X</a>
                    @else
                            <span
                                class="xMark  delete-from-db check_tag"
                                data-delete-id="{{ $item->id }}" data-table="{{ $relation }}"
                                data-model-id="{{ $item->$relation?->id }}" data-pivot-table="{{ $relation }}"
                                data-relation-type="{{$relationtype}}"
                                data-value="{{ $item[$name] }}"
                            >X
                     </span>
                    @endif
                @endif
            </div>
        @endif
    </div>
</div>

