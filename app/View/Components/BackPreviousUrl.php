<?php

namespace App\View\Components;

use App\Traits\HelpersTraits;
use Illuminate\View\Component;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class BackPreviousUrl extends Component
{
    public $url;
    public bool $submit;
    public bool $back;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $submit = false,bool $back = false)
    {
        $this->submit = $submit;
        $this->back = $back;
        if ($back){
            $route = HelpersTraits::getModelFromUrl();
            if ($route->redirect){
                $this->url = ['redirect' =>$route->redirect.'.edit','params' => $route->id];
            }else{
                $this->back = false;
            }
        }
//        try {
//           $this->url = HelpersTraits::getPreviousUrl();
//        } catch (MethodNotAllowedHttpException $exception) {
//            $this->url = 'home';
//        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.back-previous-url');
    }
}
