<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DateFilterSearch extends Component
{
    public $name;
    public $inpName;
    public $searchData;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$inpName,$searchData)
    {
        $this->name = $name;
        $this->inpName = $inpName;
        $this->searchData = $searchData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.date-filter-search');
    }
}
