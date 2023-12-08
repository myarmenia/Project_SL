<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class TegsRelations extends Component
{
    public object $model;
    public string|null $relations;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(object $model, string|null $relations = null)
    {
        $this->model = $model;
        $this->relations = $relations;

        if ($this->relations){
            $this->model->modelRelations = $this->model->$relations;
        }
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
