<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoupleRequest;
use App\Models\Couple;
use App\Models\Month;
use App\Services\CoupleService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CoupleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CoupleService $coupleService)
    {
        return view('couples.index', [
            'couples' => $coupleService->getAllCouples(),
            'current_month' => Carbon::now()->month,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CoupleService $coupleService)
    {
        return view('couples.create', [
            'kb_services' => $coupleService->getAllKbServices(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoupleRequest $request, CoupleService $coupleService)
    {
        $coupleService->store($request);
        return redirect()->route('couples.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function show(Couple $couple, CoupleService $coupleService)
    {
        $year = Carbon::now()->year;

        return view('couples.show', [
            'couple' => $couple,
            'kb_statuses' => $coupleService->getKbStatuses($couple),
            'kb_anual_report' => $coupleService->getKbAnualReport($couple, $year),
            'months' => Month::all(),
            'year' => $year,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function edit(Couple $couple)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Couple $couple)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function destroy(Couple $couple)
    {
        //
    }
}
