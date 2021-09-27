<?php

namespace App\Http\Livewire\People;

use App\Models\Person;
use Livewire\Component;

class CoupleStatusForm extends Component
{
    public $marital_statuses, $kb_services;

    public $husband_search_term;

    public $husbands;

    public function getHusbands()
    {
        // hanya mencari suami
        return Person::where('sex_id', 1)
            ->whereIn('marital_status_id', [2, 3])
            ->where(function($query){
                $query->where('name', 'like', $this->husband_search_term . '%');
            })->get();
    }

    public function render()
    {
        $this->husbands = $this->getHusbands();

        return view('livewire.people.couple-status-form');
    }
}
