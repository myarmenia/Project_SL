<div class="row gap-2">
    @foreach($model->modelRelations as $key => $relation)
        @if($model->$relation instanceof \Illuminate\Database\Eloquent\Collection)
            <x-tegs :data="$model" :relation="$relation" name="id" :label="__('content.'.$relation)" :tableName="$relation" related/>
        @else
            <x-teg :item="$model" :relation="$otherRelation ?? $relation" :relations="$relations" name="id" :labels="isset($labels) ? $labels[$key] : null" :tableName="$tableName" related/>
        @endif
    @endforeach
</div>
