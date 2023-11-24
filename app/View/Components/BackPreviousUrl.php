<?php

namespace App\View\Components;

use App\Traits\HelpersTraits;
use Illuminate\View\Component;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class BackPreviousUrl extends Component
{
    public $url;
    public bool $submit;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $submit = false)
    {
        try {
           $this->url = HelpersTraits::getPreviousUrl();
        } catch (MethodNotAllowedHttpException $exception) {

        }

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
