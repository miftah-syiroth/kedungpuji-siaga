<?php

namespace App\Http\Livewire\Families;

use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class FamilyCreate extends Component
{
    public $keluarga_sejahtera;
    public $kepala_keluarga;

    public $searchTerm;

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
        // tampilkan semua org dengan status anggota sebagai kepala keluarga, yang blm tercatat pada model keluarga, dan sesuai keyword

        $this->kepala_keluarga = $this->getKepalaKeluarga();

        return view('livewire.families.family-create');
    }
}
