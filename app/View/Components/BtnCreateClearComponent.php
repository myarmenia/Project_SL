<?php

namespace App\View\Components;

use App\Traits\HelpersTraits;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class BtnCreateClearComponent extends Component
{
    public string $route;
    public array|null $routeParams;
    public bool $show;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, Request $request, array|null $routeParams = null)
    {
        $this->routeParams = $routeParams;
        $this->show = $request->has('add') ||$request->model === 'bibliography' || request()->main_route && in_array(request()->route()->parameters['page'], ['man','car','address','organization','weapon']);
        $this->route = $route;
        if ($request->model === 'bibliography'){
            $this->routeParams = ['model' => request()->model,'id' => request()->id];
        }
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
