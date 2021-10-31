<?php

namespace App\Http\Livewire\KeluargaBerencana;

use App\Models\Couple;
use App\Models\Month;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class IndexTable extends Component
{
    public $couples;
    public $months;

    public function getCouples()
    {
        return Couple::whereHas('wife', function (Builder $query) {
            $query->whereDate('date_of_birth', '<=', Carbon::now()->addYears(-15) )
                ->whereDate('date_of_birth', '>=', Carbon::now()->addYears(-49) );
        })->with(['kbService', 'keluargaBerencana.kbStatus', 'keluargaBerencana' => function($query){
            $query->where('year_periode', Carbon::now()->year);
        }])->get();
    }

    public function mount()
    {
        $this->couples = $this->getCouples();
        $this->months = Month::all();
    }
    
    public function render()
    {
        return view('livewire.keluarga-berencana.index-table');
    }
}
