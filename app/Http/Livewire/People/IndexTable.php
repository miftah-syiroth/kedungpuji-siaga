<?php

namespace App\Http\Livewire\People;

use App\Models\Person;
use Livewire\Component;

class IndexTable extends Component
{
    public $people;

    public function mount()
    {
        $this->people = Person::with([
            'bloodGroup',
            'maritalStatus',
            'sex',
            'family'
        ])->where('is_alive', true)->where('village_id', 1)->orderBy('name', 'asc')->get();
    }
    
    public function render()
    {
        return view('livewire.people.index-table');
    }
}
