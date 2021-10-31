<?php

namespace App\Http\Livewire\Couples;

use App\Models\Couple;
use Livewire\Component;

class IndexTable extends Component
{
    public $couples;

    public function getCouples()
    {
        return Couple::with([
            'husband', 
            'wife' => function ($query) {
                $query->where('is_alive', true)
                    ->where('village_id', 1);
            },
            // 'wife.maritalStatus',
            'kbService',
        ])->get();
    }

    public function mount()
    {
        $this->couples = $this->getCouples();
    }

    public function render()
    {
        return view('livewire.couples.index-table');
    }
}
