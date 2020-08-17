<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UpdatedComponent extends Component
{
    public $date;
    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($date = null, $name =null )
    {
        $this->date = $date;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.updated-component');
    }
}
