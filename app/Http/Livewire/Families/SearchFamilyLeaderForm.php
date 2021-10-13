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
        // ambil person yang blm punya relasi mnjd kepala keluarga dan status anggotanya 1
        return Person::doesntHave('family')
            // ->where('family_status_id', 1) //kepala keluarga
            ->where('marital_status_id', '!=', 1) //menikah
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
