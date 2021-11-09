<?php

namespace App\Http\Controllers\Invokables;

use App\Http\Controllers\Controller;
use App\Models\Month;
use App\Models\Sex;
use App\Services\PregnancyService;
use Illuminate\Http\Request;

class IbuNifas extends Controller
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
        $filters = request()->all();
        return view('pregnancies.ibu-nifas', [
            'pregnancies' => $this->pregnancyService->getIbuNifas($filters),
            'months' => Month::all(),
        ]);
    }
}
