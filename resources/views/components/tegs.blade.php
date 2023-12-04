<div class="tegs-div">
    <div class="tegs-div-content">
        @if (isset($dataWithrelation) && count($dataWithrelation))
            @foreach ($dataWithrelation as $item)
                <div class="Myteg @if  ($comment) video-teg-class @endif">
                    <span class="teg-text"
                    @if($related)
                        class="open-relation-field" data-table-name="{{ $tableName }}" data-id="{{ $item->id }}"
                    @endif>
                        {{ $item['label'] }}</span>
                    @if ($edit)
                         <span class="edit-pen">
                              <a href="{{route($edit['page'] ,array_merge($edit,[$item['id']]))}}">
                                  <i class="bi bi-pen"></i>
                              </a>
                         </span>
                    @endif
                    @if ($comment)
                        <textarea class="  save_input_data video_teg_text_area" data-type="update_field" name="file_comment" id="" cols="30"
                            rows="1">{{ $item->file_comment }}</textarea>
                    @endif

                    @if($delete)
                        <span
                            class="xMark @if ($comment) delete-items-from-db @else delete-from-db check_tag @endif"
                            data-delete-id="{{ $item->id }}" data-table="{{ $relation }}"
                            data-model-id="{{ $dataItem->id }}" data-pivot-table="{{ $relation }}"
                            @if ($comment) data-model-name="Bibliography"
                              @else
                                  data-value="{{ $item[$name] }}" @endif
                            @if (isset($relationtype)) data-relation-type="{{ $relationtype }}" @endif>X
                        </span>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>
