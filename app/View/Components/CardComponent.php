<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardComponent extends Component
{
    public $title;
    public $subtitle;
    public $items;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $subtitle, $items=[])
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card-component');
    }
}
