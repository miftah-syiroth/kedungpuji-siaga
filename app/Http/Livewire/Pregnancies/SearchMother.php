<?php

namespace App\Http\Livewire\Pregnancies;

use App\Models\Person;
use Carbon\Carbon;
use Livewire\Component;

class SearchMother extends Component
{
    public $mothers;

    public $mother_search_term;

    public function getMothers()
    {
        // cari org yg punya suami (cewe menikah) dan dia usia subur
        return Person::has('husband')
            ->where('is_alive', true)
            ->where('village_id', 1)
            ->where('sex_id', 2)
            ->where(function ($query) {
                $query->where('name', 'like', $this->mother_search_term . '%');
            })->get();
    }

    public function render()
    {
        $this->mothers = $this->getMothers();

        return view('livewire.pregnancies.search-mother');
    }
}
