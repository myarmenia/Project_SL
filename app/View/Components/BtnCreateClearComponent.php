<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\View\Component;

class BtnCreateClearComponent extends Component
{
    public string $route;
    public bool $show;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, Request $request)
    {
//        dd( );
        $this->show = $request->has('add') || request()->main_route && in_array(request()->route()->parameters['page'], ['man','car','address','organization','weapon']);
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.btn-create-clear-component');
    }
}
