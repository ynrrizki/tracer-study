<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class offcanvas extends Component
{
    protected $title, $id;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $id)
    {
        $this->title = $title;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $title = $this->title;
        $id = $this->id;
        return view('components.offcanvas', compact('title', 'id'));
    }
}
