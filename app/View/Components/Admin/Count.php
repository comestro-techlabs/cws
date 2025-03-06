<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Count extends Component
{
    /**
     * Create a new component instance.
     */
    public $count;
    public $bgColor;
    public $hoverColor;

    public function __construct($count, $bgColor = 'purple-400', $hoverColor = 'purple-500')
    {
        $this->count = $count;
        $this->bgColor = $bgColor;
        $this->hoverColor = $hoverColor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.count');
    }
}
