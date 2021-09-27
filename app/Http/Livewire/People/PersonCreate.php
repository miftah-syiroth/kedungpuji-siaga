<?php

namespace App\Http\Livewire\People;

use Livewire\Component;

class PersonCreate extends Component
{   
    // properti dengan relasi dan dipassing dari controller
    public $family_statuses, $sexes, $blood_groups, $religions, $marital_statuses, $disabilities, $educationals, $keluarga_sejahtera, $kb_services;

    public function render()
    {
        return view('livewire.people.person-create');
    }
}
