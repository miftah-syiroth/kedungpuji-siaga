<?php

namespace App\Http\Livewire\Families;

use App\Models\Person;
use Livewire\Component;

class LeaderSearchForm extends Component
{
    public $leaders;
    public $leader_search_term; // input pencarian yang dimasukkan user

    public function getLeaders()
    {
        // ambil person yang blm punya relasi mnjd kepala keluarga dan status anggotanya 1
        return Person::doesntHave('family')
            ->doesntHave('ledFamily')
            ->where('is_alive', true)
            ->where('village_id', 1)
            ->where('marital_status_id', '!=', 1) //menikah
            ->where(function ($query) {
                $query->where('name', 'like', $this->leader_search_term . '%');
            })->get();
    }

    public function render()
    {
        $this->leaders = $this->getLeaders();

        return view('livewire.families.leader-search-form');
    }
}
