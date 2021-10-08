<?php

namespace App\View\Components\People;

use Illuminate\View\Component;

class PersonalData extends Component
{
    public $person;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($person)
    {
        $this->person = $person;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.people.personal-data');
    }
}
