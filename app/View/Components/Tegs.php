<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tegs extends Component
{
    public null|object $dataItem;
    public string $relation;
    public  $dataWithrelation;
    public string $name;
    public string|null $label;
    public bool|null $delete;
    public string|null $relationtype;
    public string|null $scope;
    public bool|null $comment;
    public array|null $edit;
    public bool|null $related;
    public string|null $tableName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        object|null $data,
        string $relation,
        string $name = 'id',
        string|null $label = '',
        bool|null $delete = false,
        string|null $relationtype = null,
        string|null $scope = null,
        string|null $scopeParam = null,
        bool|null $comment = false,
        array|null $edit = null,
        bool|null $related = false,
        string|null $tableName = null
    ) {
        $this->dataItem = $data;
        $this->relation = $relation;
        $this->name = $name;
        $this->label = $label;
        $this->delete = $delete;
        $this->relationtype = $relationtype;
        $this->scope = $scope;
        $this->comment = $comment;
        $this->edit = $edit;
        $this->related = $related;
        $this->tableName = $tableName;

        if (!$this->dataItem) return;
        if ($scope) {
            $this->dataWithrelation = $this->dataItem->$relation()->$scope($scopeParam);
        }else{
            $this->dataWithrelation = $this->dataItem->$relation;
        }
        foreach ($this->dataWithrelation as &$item) {

//            if ($relation === 'organization_has_man'){
//                dd($this->name);
//                dd($item['id']);
//            }
            $item['label'] = $label ? $label.' : '.$item[$name] : $item[$name];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tegs');
    }
}
