<?php

namespace App\Http\Livewire\Families;

use App\Models\Person;
use Livewire\Component;

class SearchMember extends Component
{
    public $people;

    public $person_search_term;

    public function getPerson()
    {
        return Person::doesntHave('family')
            ->doesntHave('ledFamily')
            ->where('is_alive', true)
            ->where('village_id', 1)
            ->whereNull('died_at')
            ->where(function ($query) {
                $query->where('name', 'like', $this->person_search_term . '%');
            })->get();
    }

    public function render()
    {
        $this->people = $this->getPerson();

        return view('livewire.families.search-member');
    }
}
