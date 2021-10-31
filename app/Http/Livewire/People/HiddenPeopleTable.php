<?php

namespace App\Http\Livewire\People;

use App\Models\Person;
use Livewire\Component;

class HiddenPeopleTable extends Component
{
    public $people;
    
    /**
     * tampilkan warga yang pindah atau mati, diurutkan dari yang pindah dulu dan berdasarkan nama
     *
     * @return void
     */
    public function mount()
    {
        $this->people = Person::with([
            'bloodGroup',
            'maritalStatus',
        ])->where('is_alive', false)->orWhere('village_id', 2)->orderBy('name', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.people.hidden-people-table');
    }
}
