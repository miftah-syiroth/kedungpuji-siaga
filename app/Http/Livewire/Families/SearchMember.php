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
        // cari orang yang ga punya relasi dengan keluarga dan status anggotanya bukan kepala keluarga
        // return Person::where('sex_id', 1)
        //     ->where('marital_status_id', '!=', 1)
        //     ->where(function ($query) {
        //         $query->where('name', 'like', $this->person_search_term . '%');
        //     })->get();
        return Person::doesntHave('family')
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
