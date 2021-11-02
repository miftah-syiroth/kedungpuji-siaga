<?php

namespace App\Http\Livewire\People;

use App\Models\Person;
use Livewire\Component;
use Livewire\WithPagination;

class IndexTable extends Component
{
    use WithPagination;

    // public $people;

    // properti untuk sorting data
    public $columnName; // nama kolom yang akan disorting
    public $sortingRule;

    
    /**
     * ganti kolom yang diklik menjadi nama
     *
     * @return void
     */
    public function sortByName()
    {
        $this->columnName = 'name';
        $this->sortingRule = $this->sortingRule == 'asc' ? 'desc' : 'asc';
        // $this->getPeople($this->columnName, $this->sortingRule);
    }

    public function sortBySex()
    {
        $this->columnName = 'sex_id';
        $this->sortingRule = $this->sortingRule == 'asc' ? 'desc' : 'asc';
        // $this->getPeople($this->columnName, $this->sortingRule);
    }

    public function sortByBirthDate()
    {
        $this->columnName = 'date_of_birth';
        $this->sortingRule = $this->sortingRule == 'asc' ? 'desc' : 'asc';
        // $this->getPeople($this->columnName, $this->sortingRule);
    }

    public function sortByBloodGroup()
    {
        $this->columnName = 'blood_group_id';
        $this->sortingRule = $this->sortingRule == 'asc' ? 'desc' : 'asc';
        // $this->getPeople($this->columnName, $this->sortingRule);
    }

    public function sortByMaritalStatus()
    {
        $this->columnName = 'marital_status_id';
        $this->sortingRule = $this->sortingRule == 'asc' ? 'desc' : 'asc';
        // $this->getPeople($this->columnName, $this->sortingRule);
    }

    public function sortByRw()
    {
        $this->columnName = 'rw';
        $this->sortingRule = $this->sortingRule == 'asc' ? 'desc' : 'asc';
        // $this->getPeople($this->columnName, $this->sortingRule);
    }

    public function getPeople()
    {
        return Person::with([
            'bloodGroup',
            'maritalStatus',
            'sex',
            'family'
        ])->where('is_alive', true)
            ->where('village_id', 1)
            ->orderBy($this->columnName, $this->sortingRule)
            ->orderBy('rt', 'asc')
            ->paginate(5);
    }

    public function mount()
    {
        $this->columnName = 'name';
        $this->sortingRule = 'asc';
    }
    
    public function render()
    {
        return view('livewire.people.index-table', [
            'people' => $this->getPeople(),
        ]);
    }
}
