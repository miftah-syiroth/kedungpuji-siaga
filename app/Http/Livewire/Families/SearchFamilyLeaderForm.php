<?php

namespace App\Http\Livewire\Families;

use App\Models\Person;
use Livewire\Component;

class SearchFamilyLeaderForm extends Component
{
    public $kepala_keluarga;
    public $searchTerm; // input pencarian yang dimasukkan user

    public function getKepalaKeluarga()
    {
        return Person::doesntHave('kepalaKeluarga')
            ->where('family_status_id', 1)
            ->where(function ($query) {
                $query->where('name', 'like', $this->searchTerm . '%');
            })->get();
    }

    public function render()
    {
        $this->kepala_keluarga = $this->getKepalaKeluarga();
        
        return view('livewire.families.search-family-leader-form');
    }
}
