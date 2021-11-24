<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ChildbirthAnnualReportExport implements FromView
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('reports.exports.childbirths-annual-report', [
            'januari' => $this->data['januari'],
            'februari' => $this->data['februari'],
            'maret' => $this->data['maret'],
            'april' => $this->data['april'],
            'mei' => $this->data['mei'],
            'juni' => $this->data['juni'],
            'juli' => $this->data['juli'],
            'agustus' => $this->data['agustus'],
            'september' => $this->data['september'],
            'oktober' => $this->data['oktober'],
            'november' => $this->data['november'],
            'desember' => $this->data['desember'],
            'year_childbirth' => $this->data['year_childbirth'],
        ]);
    }
}
