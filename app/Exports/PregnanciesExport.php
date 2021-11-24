<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PregnanciesExport implements FromView
{
    protected $pregnancies;

    public function __construct($pregnancies)
    {
        $this->pregnancies = $pregnancies;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('reports.exports.pregnancies', [
            'pregnancies' => $this->pregnancies,
        ]);
    }
}
