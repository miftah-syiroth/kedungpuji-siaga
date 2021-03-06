<?php

namespace App\Http\Livewire\Couples;

use App\Models\Person;
use Livewire\Component;

class SearchHusband extends Component
{
    public $husband_search; // untuk pencarian
    public $husbands; // model utk menyimpan atribut suami

    public function searchHusband()
    {
        // cari org dgn kelamin laki2, dan status kawin tercatata atau tidak tercatat, sesuai pencarian
        $this->husbands = Person::where('is_alive', true)
            ->where('village_id', 1)
            ->where('sex_id', 1)
            ->whereIn('marital_status_id', [2, 3]) //menikah
            ->where(function($query){
                $query->where('name', 'like', $this->husband_search . '%');
            })->get();
    }

    public function render()
    {
        $this->searchHusband();
        return view('livewire.couples.search-husband');
    }
}
