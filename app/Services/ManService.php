<?php

namespace App\Services;

use App\Models\Man\Man;
use Illuminate\Support\Facades\DB;

class ManService
{
    /**
     * @return int
     */
    public function store(): int
    {
        return Man::create()->id;
    }

    public function update(object $man, array $attributes): void
    {
        $newData = [$attributes['fieldName'] => $attributes['value']];

        if (isset($attributes['intermediate'])) {
            $model = $attributes['model'];

            if (isset($attributes['location'])){
                 $this->updateLocationFields($man, $model, $attributes,$newData);
            }else{
                if (method_exists($man, $model)) {
                    $man->$model()->create($newData);
                } else {
                    $man->belongsToManyRelation($model, $attributes['table'] ?? $attributes['fieldName'])->create($newData);
                }
            }
        } else {
            $man->update($newData);
        }
    }

    public function updateLocationFields(object $man, string $model, array $attributes, array $newData): void
    {
        if ($man->country()->exists()){

            $countryField = DB::table($model)->where('id', $man->country->first()[$model.'_id']);
            if ($countryField->exists()){
                $countryField->update($newData);
            }else{
                $modelId = DB::table($model)->insertGetId($newData);
                $man->country()->update([$model.'_id'=>$modelId]);
                $man->address()->update([$model.'_id'=>$modelId]);
            }
        }else{
            $pivot = $man->country()->create();
            $modelId = $pivot->$model()->create($newData)->id;
            $pivot->update([$model.'_id'=>$modelId]);
            $man->address()->create([$model.'_id'=>$modelId]);
        }
    }
}
