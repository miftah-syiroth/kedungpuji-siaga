<?php

namespace App\Http\Controllers\Invokables;

use App\Exports\ChildbirthAnnualReportExport;
use App\Http\Controllers\Controller;
use App\Services\ChildbirthService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ChildbirthAnnualReport extends Controller
{
    private $childbirthService;

    public function __construct(ChildbirthService $service)
    {
        $this->childbirthService = $service;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $export = new ChildbirthAnnualReportExport([
            'januari' => $this->childbirthService->childbirthAnnualReport(1, $request->year_childbirth),
            'februari' => $this->childbirthService->childbirthAnnualReport(2, $request->year_childbirth),
            'maret' => $this->childbirthService->childbirthAnnualReport(3, $request->year_childbirth),
            'april' => $this->childbirthService->childbirthAnnualReport(4, $request->year_childbirth),
            'mei' => $this->childbirthService->childbirthAnnualReport(5, $request->year_childbirth),
            'juni' => $this->childbirthService->childbirthAnnualReport(6, $request->year_childbirth),
            'juli' => $this->childbirthService->childbirthAnnualReport(7, $request->year_childbirth),
            'agustus' => $this->childbirthService->childbirthAnnualReport(8, $request->year_childbirth),
            'september' => $this->childbirthService->childbirthAnnualReport(9, $request->year_childbirth),
            'oktober' => $this->childbirthService->childbirthAnnualReport(10, $request->year_childbirth),
            'november' => $this->childbirthService->childbirthAnnualReport(11, $request->year_childbirth),
            'desember' => $this->childbirthService->childbirthAnnualReport(12, $request->year_childbirth),
            'year_childbirth' => $request->year_childbirth,
        ]);

        return Excel::download($export, 'childbirth_annual_report.xlsx');
        
        // return view('reports.exports.childbirths-annual-report', [
        //     'januari' => $this->childbirthService->childbirthAnnualReport(1, 2021),
        //     'februari' => $this->childbirthService->childbirthAnnualReport(1, 2021),
        // ]);
    }
}
