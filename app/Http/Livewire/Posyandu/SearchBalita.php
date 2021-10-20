<?php

namespace App\Http\Livewire\Posyandu;

use App\Models\Person;
use Carbon\Carbon;
use Livewire\Component;

class SearchBalita extends Component
{
    public $balita;
    public $searchTerm; 

    public function getBalita()
    {
        // cari orang yang punya ibu dan umurnya kurang dari 5 tahun
        return Person::has('mother')
            ->doesntHave('posyandu')
            ->whereDate('date_of_birth', '>=', Carbon::now()->addYears(-5) )
            ->where(function ($query) {
                $query->where('name', 'like', $this->searchTerm . '%');
            })->get();
    }

    public function render()
    {
        $this->balita = $this->getBalita();

        return view('livewire.posyandu.search-balita');
    }
}
