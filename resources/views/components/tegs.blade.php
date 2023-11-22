<div class="tegs-div">
    <div class="tegs-div-content">
        @if (isset($dataWithrelation) && count($dataWithrelation))
            @foreach ($dataWithrelation as $item)
                <div class="Myteg @if($comment) video-teg-class @endif" >
                    <span class=""><a href="#">{{ $item['label'] }}</a></span>
                    @if(isset($edit))
                        <span class="edit-pen"><a href="#"><i class="bi bi-pen"></i></a></span>
                    @endif
                    @if($comment)
                        <textarea
                            class="form-control save_input_data"
                            data-type="update_field"
                            name="file_comment" id="" cols="30" rows="10">{{$item->file_comment}}</textarea>
                    @endif
                    @if(isset($delete))
                        <span class="xMark @if($comment)delete-items-from-db @else delete-from-db check_tag @endif"
                              data-delete-id="{{ $item->id }}"
                              data-table="{{ $relation }}"
                              data-model-id="{{ $dataItem->id }}"
                              data-pivot-table="{{ $relation }}"
                              @if($comment)
                                  data-model-name="Bibliography"
                              @else
                                  data-value="{{ $item[$name] }}"
                              @endif
                              @if (isset($relationtype)) data-relation-type="{{ $relationtype }}" @endif>X
                        </span>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>
