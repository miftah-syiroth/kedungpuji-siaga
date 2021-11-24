<?php

namespace App\Http\Controllers\Invokables;

use App\Exports\PregnancyAnnualReportExport;
use App\Http\Controllers\Controller;
use App\Services\PregnancyService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PregnanciesAnnualReport extends Controller
{
    private $pregnancyService;

    public function __construct(PregnancyService $service)
    {
        $this->pregnancyService = $service;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $export = new PregnancyAnnualReportExport([
            'januari' => $this->pregnancyService->pregnancyAnnualReport(1, $request->year_hpht),
            'februari' => $this->pregnancyService->pregnancyAnnualReport(2, $request->year_hpht),
            'maret' => $this->pregnancyService->pregnancyAnnualReport(3, $request->year_hpht),
            'april' => $this->pregnancyService->pregnancyAnnualReport(4, $request->year_hpht),
            'mei' => $this->pregnancyService->pregnancyAnnualReport(5, $request->year_hpht),
            'juni' => $this->pregnancyService->pregnancyAnnualReport(6, $request->year_hpht),
            'juli' => $this->pregnancyService->pregnancyAnnualReport(7, $request->year_hpht),
            'agustus' => $this->pregnancyService->pregnancyAnnualReport(8, $request->year_hpht),
            'september' => $this->pregnancyService->pregnancyAnnualReport(9, $request->year_hpht),
            'oktober' => $this->pregnancyService->pregnancyAnnualReport(10, $request->year_hpht),
            'november' => $this->pregnancyService->pregnancyAnnualReport(11, $request->year_hpht),
            'desember' => $this->pregnancyService->pregnancyAnnualReport(12, $request->year_hpht),
            'year_hpht' => $request->year_hpht,
        ]);

        return Excel::download($export, 'pregnancy_annual_report.xlsx');

        // return view('reports.exports.pregnancies-annual-report', [
        //     'januari' => $this->pregnancyService->pregnancyAnnualReport(1, $request->year_hpht),
        //     'februari' => $this->pregnancyService->pregnancyAnnualReport(2, $request->year_hpht),
        //     'maret' => $this->pregnancyService->pregnancyAnnualReport(3, $request->year_hpht),
        //     'year_hpht' => $request->year_hpht,
        // ]);
    }
}
