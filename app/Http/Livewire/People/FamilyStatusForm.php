<?php

namespace App\Http\Livewire\People;

use App\Models\Person;
use Livewire\Component;

class FamilyStatusForm extends Component
{
    public $family_statuses, $keluarga_sejahtera;

    public $family_search_term;

    public $family_leaders;

    public function getFamilies()
    {
        return Person::has('kepalaKeluarga')
            ->where('family_status_id', 1)
            ->where(function ($query) {
                $query->where('name', 'like', $this->family_search_term . '%');
            })->get();
    }

    public function render()
    {
        $this->family_leaders = $this->getFamilies();

        return view('livewire.people.family-status-form');
    }
}
