<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StepOne extends Component
{
    public $pcategory;
    public $state;
    public function __construct($pcategory,$state)
    {
        $this->pcategory = $pcategory;
        $this->state = $state;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.step-one');
    }
}
