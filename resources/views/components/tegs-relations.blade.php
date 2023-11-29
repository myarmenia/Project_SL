@foreach($model->modelRelations as $relation)
    <x-tegs name="id" :data="$model" :relation="$relation" :label="__('content.'.$relation)" :tableName="$relation" related />
@endforeach
