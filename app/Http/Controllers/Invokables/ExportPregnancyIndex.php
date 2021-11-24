<?php

namespace App\Http\Controllers\Invokables;

use App\Exports\PregnanciesExport;
use App\Http\Controllers\Controller;
use App\Services\PregnancyService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportPregnancyIndex extends Controller
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
        // ambil data pregnancies yang akan diexport
        $pregnancies = $this->pregnancyService->getPregnanciesToExport($request);
        $export = new PregnanciesExport($pregnancies);

        return Excel::download($export, 'pregnancies.xlsx');
    }
}
