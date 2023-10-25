<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Man\Man;
use Illuminate\Http\Request;

class ModelRelationController extends Controller
{
    public function get_relations(Request $request){



        $table_name = 'man';
        $modelname = app('App\Models\\' . ucfirst($table_name) .'\\'. ucfirst($table_name));

        // $row = $modelname->with($modelname->modelRelations)->find(2);
        $row = $modelname->with($modelname->modelRelations)->find(2);

        $relations = $row->getRelations();
        // $re = $row->with($modelname->modelRelations);
        foreach ($relations as $key => $relation) {
            $relation = $relation->toArray();
            dump($relation);
           if((is_array($relation) && $relation != null ) || (is_array($relation) && count($relation) > 0) ){
            dump('ka');
           }
           else{
            dump('chka');
           }
        }
        // dd($row->getRelations());
        dd($row->getRelations());



    }
}
