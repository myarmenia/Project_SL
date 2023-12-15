<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class TegsRelations extends Component
{
    public object $model;
    public string|array|null $relations;
    public string|null $otherRelation;
    public array|null $labels = null;
    public string|null $label = null;
    public string|null $tableName = null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(object $model, string|null $relations = null, string|null $otherRelation = null)
    {
        $this->model = $model;
        $this->labels = $this->model->$relations;
        $this->relations = $relations;
        $this->otherRelation = $otherRelation;

        if ($this->relations === 'tegsRelations'){
            $newModelRelations = [];
            $this->tableName = 'objects_relation';
            foreach ($this->model->tegsRelations as $key => &$relation){

                $newModelRelations[] = $relation['relation'];
            }
            $this->model->modelRelations =$newModelRelations;
            $this->relations = $this->model->modelRelations;
        }
//        dd($this->model->modelRelations);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tegs-relations');
    }
}
