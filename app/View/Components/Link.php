<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Link extends Component
{
    public $title, $route, $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $route, $icon)
    {
        $this->title = $title;
        $this->route = $route;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.link');
    }
}
