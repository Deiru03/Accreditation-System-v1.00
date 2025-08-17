<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $bgColor;
    public $borderColor;
    public $textColor;
    public $hoverColor;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $bgColor = 'bg-blue-900',
        $borderColor = 'border-blue-800',
        $textColor = 'text-white',
        $hoverColor = 'bg-blue-800',
        $title = 'Sidebar'
    ) {
        $this->bgColor = $bgColor;
        $this->borderColor = $borderColor;
        $this->textColor = $textColor;
        $this->hoverColor = $hoverColor;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}