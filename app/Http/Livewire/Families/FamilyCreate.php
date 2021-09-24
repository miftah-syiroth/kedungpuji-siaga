<?php

namespace App\Http\Livewire\Families;

use App\Models\Person;
use Livewire\Component;

class FamilyCreate extends Component
{
    public $keluarga_sejahtera;
    public $kepala_keluarga;

    public $searchTerm;

    public function render()
    {
        $this->kepala_keluarga = Person::where('family_status_id', 1)
            ->whereNull('family_id')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })->select('id', 'name')->get();

        return view('livewire.families.family-create');
    }
}
