<div class="row gap-2">
    @foreach($model->modelRelations as $relation)
        @if($model->$relation instanceof \Illuminate\Database\Eloquent\Collection)
            <x-tegs name="id" :data="$model" :relation="$relation" :label="__('content.'.$model->first_object_type)" :tableName="$relation" related/>
        @else
            <x-teg :item="$model->$relation" name="id" :label="__('content.'.$model->first_object_type)"/>
        @endif
    @endforeach
</div>
