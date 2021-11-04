<?php

namespace App\View\Components\People;

use Illuminate\View\Component;

class PosyanduData extends Component
{
    public $person;
    public $latestPosyandu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($person)
    {
        $this->person = $person;
        $this->latestPosyandu = $person->posyandu->latestAnthropometry ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.people.posyandu-data');
    }
}
