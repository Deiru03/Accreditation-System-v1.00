<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notification extends Component
{
    
    public $type;
    public $message;

    /**
     * Create a new component instance.
     *
     * @param string $type
     * @param string $message
     */
    public function __construct($type = 'info', $message = null)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.notification');
    }
}