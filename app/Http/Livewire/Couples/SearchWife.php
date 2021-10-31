<?php

namespace App\Http\Livewire\Couples;

use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SearchWife extends Component
{
    public $wife_search;
    public $wifes;

    public function searchWife()
    {
        $this->wifes = Person::where('is_alive', true)
            ->where('village_id', 1)
            ->where('sex_id', 2)
            ->whereIn('marital_status_id', [2, 3])
            ->doesntHave('husband')
            ->where(function($query){
                $query->where('name', 'like', $this->wife_search . '%');
            })->get();
    }

    public function render()
    {
        $this->searchWife();
        return view('livewire.couples.search-wife');
    }
}
