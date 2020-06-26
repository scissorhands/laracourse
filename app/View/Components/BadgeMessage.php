<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BadgeMessage extends Component
{
    public $type;
    public $show = false;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type=null, $show=false)
    {
        $this->type = $type;
        $this->show = $show;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.badge-message');
    }
}
