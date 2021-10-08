<?php

namespace App\View\Components\People;

use App\Models\Month;
use Illuminate\View\Component;

class KeluargaBerencanaData extends Component
{
    public $person;
    public $months;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($person)
    {
        $this->person = $person;
        $this->months = Month::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.people.keluarga-berencana-data');
    }
}
