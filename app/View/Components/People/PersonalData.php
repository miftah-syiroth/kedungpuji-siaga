<?php

namespace App\View\Components\People;

use Illuminate\View\Component;

class PersonalData extends Component
{
    public $person;
    public $descendants;

    /**
     * Create a new component instance.
     * pada model person terdapat dua relasi yaitu anak dari ibu dan anak dari ayah. dibedakan dari jenis kelaminnya
     *
     * @return void
     */
    public function __construct($person)
    {
        $this->person = $person;

        if ($person->sex_id == 1) { // laki2
            $this->descendants = $person->fatherChildren()->orderBy('date_of_birth', 'asc')->get();
        } else { // perempuan
            $this->descendants = $person->motherChildren()->orderBy('date_of_birth', 'asc')->get();
        }
        
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
