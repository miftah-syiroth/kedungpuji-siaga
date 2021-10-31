<?php

namespace App\Http\Livewire\People;

use App\Models\Person;
use Livewire\Component;

class FatherSearchForm extends Component
{
    public $fathers;
    public $father_search_term;

    public function getFathers()
    {
        // cari org yg masih hidup, berkelamin laki2, dah bukan belum kawin
        return Person::where('sex_id', 1)
            ->where('marital_status_id', '!=', 1)
            ->where(function ($query) {
                $query->where('name', 'like', $this->father_search_term . '%');
            })->get();
    }

    public function render()
    {
        $this->fathers = $this->getFathers();
        return view('livewire.people.father-search-form');
    }
}
