<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class table extends Component
{
    protected $headers, $data, $delete, $show, $offcanvasId, $canDelete, $canEdit, $canShow;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $headers = [],
        $data = [],
        $delete = null,
        $show = null,
        $offcanvasId = null,
        $canDelete = true,
        $canEdit = true,
        $canShow = false,
    ) {
        $this->headers = $headers;
        $this->data = $data;
        $this->delete = $delete;
        $this->show = $show;
        $this->offcanvasId = $offcanvasId;
        $this->canDelete = $canDelete;
        $this->canEdit = $canEdit;
        $this->canShow = $canShow;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $headers = $this->headers;
        $data   = $this->data;
        $delete = $this->delete;
        $show = $this->show;
        $offcanvasId = $this->offcanvasId;
        $canDelete = $this->canDelete;
        $canEdit = $this->canEdit;
        $canShow = $this->canShow;

        return view('components.table', compact(
            'headers',
            'data',
            'delete',
            'show',
            'offcanvasId',
            'canDelete',
            'canEdit',
            'canShow',
        ));
    }
}
