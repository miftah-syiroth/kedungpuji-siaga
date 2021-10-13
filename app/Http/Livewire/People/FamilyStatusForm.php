<?php

namespace App\Http\Livewire\People;

use App\Models\Family;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class FamilyStatusForm extends Component
{
    public $person, $family_statuses, $keluarga_sejahtera;

    public $family_search_term;

    public $families;

    public function getFamilies()
    {
        return Family::whereHas('leader', function (Builder $query) {
            $query->where('name', 'like', $this->family_search_term . '%');
        })->get();
    }

    public function mount($person)
    {
        # code...
    }

    public function render()
    {
        $this->families = $this->getFamilies();

        return view('livewire.people.family-status-form');
    }
}
