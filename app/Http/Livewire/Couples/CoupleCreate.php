<?php

namespace App\Http\Livewire\Couples;

use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class CoupleCreate extends Component
{
    public $kb_services;
    public $husbands;
    public $wifes;

    // untuk pencarian orang
    public $husband_search;
    public $wife_search;

    public function render()
    {
        // cari org dgn kelamin laki2, dan status kawin tercatata atau tidak tercatat, sesuai pencarian
        $this->husbands = Person::where('sex_id', 1)
            ->whereIn('marital_status_id', [2, 3])
            ->where(function($query){
                $query->where('name', 'like', $this->husband_search . '%');
            })->get();

        // cari org dgn kelamin wanita, dan status kawin tercatata atau tidak tercatat, dan yang belum memiliki relasi pasangan ke model couple, dan sesuai pencarian
        $this->wifes = Person::whereDoesntHave('husband', function(Builder $query) {
                $query->where('sex_id', 2)
                    ->whereIn('marital_status_id', [2, 3]);
            })->where(function($query){
                $query->where('name', 'like', $this->wife_search . '%');
            })->get();

        return view('livewire.couples.couple-create');
    }
}
