<div class="row gap-2">
    @foreach($model->modelRelations as $relation)
   @if(count($model->modelRelations) > 1)
            <x-tegs name="id" :data="$model" :relation="$relation" :label="__('content.'.$relation)" :tableName="$relation" related/>
        @else
            <x-teg :item="$model->$relation" name="id" :label="__('content.'.$relation)"/>
        @endif
    @endforeach
</div>
