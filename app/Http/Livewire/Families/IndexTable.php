<?php

namespace App\Http\Livewire\Families;

use App\Models\Family;
use Livewire\Component;

class IndexTable extends Component
{
    public $families;

    public function getFamilies()
    {
        return Family::with([
            'leader' => function ($query) {
                $query->where('is_alive', true)
                    ->where('village_id', 1);
            },
            'keluargaSejahtera',
        ])->withCount('people')->get();
    }

    public function mount()
    {
        $this->families = $this->getFamilies();
    }

    public function render()
    {
        return view('livewire.families.index-table');
    }
}
