<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KbMonthlyReportExport implements FromView
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('reports.exports.kb-monthly-report', [
            'rw' => $this->data['rw'],
            'periode' => $this->data['periode'],
            'all_rt' => $this->data['all_rt'],
        ]);
    }
}
