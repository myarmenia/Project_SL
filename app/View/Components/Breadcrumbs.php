<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public null|int $id;
    public string $title;
    public null|array $crumbs;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, array $crumbs = [], $id = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->crumbs = $crumbs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumbs');
    }
}
