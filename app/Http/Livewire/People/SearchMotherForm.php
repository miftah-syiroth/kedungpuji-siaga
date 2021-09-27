<?php

namespace App\Http\Livewire\People;

use App\Models\Person;
use Livewire\Component;

class SearchMotherForm extends Component
{
    public $mothers;

    public $mother_search_term;

    public function getMothers()
    {
        // cari org yg kelamin perempuan & sudah/pernah menikah & sesuai keyword
        return Person::where('sex_id', 2)
            ->where('marital_status_id', '!=', 1)
            ->where(function ($query) {
                $query->where('name', 'like', $this->mother_search_term . '%');
            })->get();
    }

    public function render()
    {
        $this->mothers = $this->getMothers();

        return view('livewire.people.search-mother-form');
    }
}
