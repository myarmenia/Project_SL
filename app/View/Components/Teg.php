<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Teg extends Component
{
    public object|null $item;
    public string|null $relation;
    public string|null $relationtype;
    public object|string|null $inputName;
    public string|null $name;
    public string|null $label;
    public string|object|null $inputValue;
    public bool|null $delete;
    public array|null $edit;
    public array|null $redirect;
    public bool|null $related = false;
    public string|null $tableName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        null|object $item,
        null|string $relation = null,
        string|null $relationtype = 'update_field',
        string|null $name = 'id',
        bool $delete = false,
        array|null $edit = null,
        null|object|string $inputName = null,
        string|object|null $inputValue = null,
        array|null $redirect = null,
        bool|null $related = false,
        string|null $tableName = null,
        string|null $label = null,
    ) {
        $this->item = $item;
        $this->relation = $relation;
        $this->inputName = $inputName;
        $this->inputValue = $inputValue;
        $this->name = $name;
        $this->label = $label;
        $this->delete = $delete;
        $this->edit = $edit;
        $this->redirect = $redirect;
        $this->related = $related;
        $this->tableName = $tableName;
        $this->relationtype = $relationtype;


        if ($relation && $this->item->$relation) {
            $this->label = $this->label ? $this->label.' : '.$this->item->$relation[$this->name] : $this->item[$this->name];
        }elseif ($item){
            $this->label = $this->label.' : '.$item['id'];
        }
//
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.teg');
    }
}
