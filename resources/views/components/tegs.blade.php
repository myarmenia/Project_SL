<div class="tegs-div">
    <div class="tegs-div-content">
        @if (isset($dataWithrelation) && count($dataWithrelation))
            @foreach ($dataWithrelation as $item)
                <div class="Myteg @if ($comment) video-teg-class @endif">
                    @if($related)
                        <span class="teg-text date_text open-relation-field" data-table-name="{{ $tableName }}" data-id="{{ $item->id }}"> {{ $item->label }}</span>
                    @else
                        <span class="teg-text date_text" >{{ $item['label'] }}</span>
                    @endif
                    @if ($edit || $moreData)
                         <span class="edit-pen">
                            @if($moreData)
                                <button class="get-data border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#additional_information">
                                    <i class="bi bi-pen"></i>
                                </button>
                             @else
                              <a href="{{route($edit['page'],array_merge($edit,[$item['id']]))}}">
                                  <i class="bi bi-pen"></i>
                              </a>
                             @endif
                         </span>
                    @endif
                    @if ($comment)
                        <textarea class="save_input_data video_teg_text_area" data-type="update_field" name="file_comment" cols="30" rows="1">
                            {{ $item->file_comment }}
                        </textarea>
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

@section('js-scripts')
    @parent
    @once
        <script>
            const content = document.querySelector('.text_area_modal')

            document.querySelectorAll('.get-data').forEach(el => {
                el.addEventListener('click', function () {
                    const element = el.closest('.Myteg').querySelector('.xMark');
                    const table = element.getAttribute('data-table')
                    const id = element.getAttribute('data-delete-id')

                    fetch(`/${lang}/${table}/${id}`,{
                        method: 'GET',
                        headers: {'Content-Type':'application/json'},
                    })
                        .then(async res => {
                            const data = await res.json()
                            content.value = data.result
                        })
                })
            })
        </script>
    @endonce
@endsection
