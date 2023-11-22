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

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        object|null $data,
        string $relation,
        string $name,
        string|null $label = '',
        bool|null $delete = false,
        string|null $relationtype = null,
        string|null $scope = null,
        string|null $scopeParam = null,
        bool|null $comment = false
    ) {
        $this->dataItem = $data;
        $this->relation = $relation;
        $this->name = $name;
        $this->label = $label;
        $this->delete = $delete;
        $this->relationtype = $relationtype;
        $this->scope = $scope;
        $this->comment = $comment;

        if (!$this->dataItem) return ;
        if ($scope) {
            $this->dataWithrelation = $this->dataItem->$relation()->$scope($scopeParam);
        }else{
            $this->dataWithrelation = $this->dataItem->$relation;
        }

        foreach ($this->dataWithrelation as &$item) {
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
