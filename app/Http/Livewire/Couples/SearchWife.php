<?php

namespace App\Http\Livewire\Couples;

use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SearchWife extends Component
{
    public $wife_search;
    public $wifes;

    public function searchWife()
    {
        // cari org dgn kelamin wanita, dan status kawin tercatata atau tidak tercatat, dan yang belum memiliki relasi pasangan ke model couple, dan sesuai pencarian
        // $this->wifes = Person::whereDoesntHave('husband', function(Builder $query) {
        //     $query->where('sex_id', 2)
        //         ->whereIn('marital_status_id', [2, 3]);
        //     })->where(function($query){
        //         $query->where('name', 'like', $this->wife_search . '%');
        //     })->get();
        $this->wifes = Person::where('sex_id', 2)
            ->whereIn('marital_status_id', [2, 3])
            ->doesntHave('husband')
            ->where(function($query){
                $query->where('name', 'like', $this->wife_search . '%');
            })->get();
    }

    // public function mount()
    // {
    //     $this->wifes = Person::where('sex_id', 2)
    //         ->whereIn('marital_status_id', [2, 3])
    //         ->doesntHave('husband')
    //         ->where(function($query){
    //             $query->where('name', 'like', $this->wife_search . '%');
    //         })->get();
    //     dd($this->wifes);
    // }

    public function render()
    {
        $this->searchWife();
        return view('livewire.couples.search-wife');
    }
}
