<?php

namespace App\View\Components\Pregnancies;

use Illuminate\View\Component;

class NewPregnancyForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pregnancies.new-pregnancy-form');
    }
}
