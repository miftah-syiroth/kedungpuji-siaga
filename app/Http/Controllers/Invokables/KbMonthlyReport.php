<?php

namespace App\Http\Controllers\Invokables;

use App\Exports\KbMonthlyReportExport;
use App\Http\Controllers\Controller;
use App\Services\KbService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KbMonthlyReport extends Controller
{
    private $kbService;

    public function __construct(KbService $service)
    {
        $this->kbService = $service;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'rw' => ['required', 'integer'],
            'month_periode' => ['required', 'integer'],
            'year_periode' => ['required', 'integer'],
        ]);
        
        $all_rt = [];
        for ($i=1; $i <= 7 ; $i++) { 
            $all_rt[$i-1] = $this->kbService->kbMonthlyReport($request, $i);
        }
        
        $periode = Carbon::createFromDate($request->year_periode, $request->month_periode);

        $export = new KbMonthlyReportExport([
            'rw' => $request->rw,
            'periode' => $periode,
            'all_rt' => $all_rt,
        ]);

        return Excel::download($export, 'kb_monthly_report.xlsx');

        // return view('reports.exports.kb-monthly-report', [
        //     'rw' => $request->rw,
        //     'periode' => $periode,
        //     'all_rt' => $all_rt,
        // ]);
    }
}
