<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public null|int $id;
    public string $title;
    public null|array $crumbs;
    public bool $fromTable;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, array $crumbs = [], $id = null)
    {
        $this->fromTable = app('router')->getRoutes()->match(app('request')->create(url()->previous()) )->action['as'] === 'open.page';
        $this->id = $id;
        $this->title = $title;
        $this->crumbs = $crumbs;

        foreach ($this->crumbs as &$item) {
            $item['route'] = route($item['route'], $item['route_param']);
            if (isset($item['parent']) && !$this->fromTable) {
                $item['route'] = route($item['parent']['route'], $item['parent']['id']);
                $item['name'] = $item['parent']['name'].' : '.$item['parent']['id'];
            }
        }
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
