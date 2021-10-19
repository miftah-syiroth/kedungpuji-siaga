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
            ->where(function ($query) {
                $query->whereDate('date_of_birth', '<=', Carbon::now()->addYears(-15) )
                ->whereDate('date_of_birth', '>=', Carbon::now()->addYears(-49) );
            })->where(function ($query) {
                $query->where('name', 'like', $this->mother_search_term . '%');
            })->get();

            // ->where('marital_status_id', '!=', 1)
            // ->where('sex_id', 2)
    }

    public function render()
    {
        $this->mothers = $this->getMothers();

        return view('livewire.pregnancies.search-mother');
    }
}
