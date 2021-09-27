<?php

namespace App\Http\Livewire\People;

use App\Models\Family;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class PersonCreate extends Component
{   
    // properti dengan relasi dan dipassing dari controller
    public $family_statuses, $sexes, $blood_groups, $religions, $marital_statuses, $disabilities, $educationals, $keluarga_sejahtera, $kb_services;

    // properti yg render di komponen
    public $family_leaders, $mothers, $fathers, $couples;

    // kata kunci pencarian
    public $family_search_term, $mother_search_term, $father_search_term, $couple_search_term;

    public function getFamilies()
    {
        return Person::has('kepalaKeluarga')
            ->where('family_status_id', 1)
            ->where(function ($query) {
                $query->where('name', 'like', $this->family_search_term . '%');
            })->get();
    }

    public function getMothers()
    {
        // cari org yg kelamin perempuan & sudah/pernah menikah & sesuai keyword
        return Person::where('sex_id', 2)
            ->where('marital_status_id', '!=', 1)
            ->where(function ($query) {
                $query->where('name', 'like', $this->mother_search_term . '%');
            })->get();
    }

    public function getFathers()
    {
        // cari org yg kelamin laki2 & sudah/pernah menikah & sesuai keyword
        return Person::where('sex_id', 1)
            ->where('marital_status_id', '!=', 1)
            ->where(function ($query) {
                $query->where('name', 'like', $this->father_search_term . '%');
            })->get();
    }

    public function getCouples()
    {
        // karena perempuan hanya punya 1 suami, maka cari org yg ga punya suami dengan status perkawinan kawin tercatat atau tidak tercatat.  yg ditampilkan bukan hanya wanita loh
        return Person::whereDoesntHave('husband', function(Builder $query) {
            $query->whereIn('marital_status_id', [2, 3]);
        })->where(function($query){
            $query->where('name', 'like', $this->couple_search_term . '%');
        })->get();
    }

    public function render()
    {
        $this->family_leaders = $this->getFamilies();
        $this->mothers = $this->getMothers();
        $this->fathers = $this->getFathers();
        $this->couples = $this->getCouples();

        return view('livewire.people.person-create');
    }
}
