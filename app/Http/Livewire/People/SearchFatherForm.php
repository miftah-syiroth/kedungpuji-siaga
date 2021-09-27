<?php

namespace App\Http\Livewire\People;

use App\Models\Person;
use Livewire\Component;

class SearchFatherForm extends Component
{
    public $fathers;

    public $father_search_term;

    public function getFathers()
    {
        // cari org yg kelamin laki2 & sudah/pernah menikah & sesuai keyword
        return Person::where('sex_id', 1)
            ->where('marital_status_id', '!=', 1)
            ->where(function ($query) {
                $query->where('name', 'like', $this->father_search_term . '%');
            })->get();
    }

    public function render()
    {
        $this->fathers = $this->getFathers();

        return view('livewire.people.search-father-form');
    }
}
