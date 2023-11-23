<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Teg extends Component
{
    public object|null $item;
    public object|string|null $inputName;
    public string|null $name;
    public string|null $label;
    public string|object|null $inputValue;
    public bool|null $delete;
    public bool|null $edit;
    public array|null $redirect;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(null|object $item, string|null $label,string|null $name = null,bool $delete = false, bool $edit = false, null|object|string $inputName = null,string|object|null $inputValue = null,array|null $redirect = null)
    {
       $this->item = $item;
       $this->inputName = $inputName;
       $this->inputValue = $inputValue;
       $this->name = $name;
       $this->label = $label;
       $this->delete = $delete;
       $this->edit = $edit;
       $this->redirect = $redirect;

       if ($this->item){
           $this->label = $this->label.' : '.$this->item['id'] ?? $this->item[$this->name].' : '.$this->item['id'];
       }
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
