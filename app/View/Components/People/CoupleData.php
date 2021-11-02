<?php

namespace App\View\Components\People;

use Illuminate\View\Component;

class CoupleData extends Component
{
    public $person;
    public $wifes;
    public $husband;

    /**
     * tampilkan data pasangannya, jika laki2 maka ambil baris data istri2nya
     * jika perempuan maka ambil satu baris data suaminya
     *
     * @return void
     */
    public function __construct($person)
    {
        // dd($person->wifes);
        $this->person = $person;
        if ($person->sex_id == 1) { // laki2
            $this->wifes = $person->wifes;
        } else {
            $this->husband = $person->husband;
        }
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.people.couple-data');
    }
}
