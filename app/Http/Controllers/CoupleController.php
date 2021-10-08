<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoupleRequest;
use App\Http\Requests\UpdateCoupleRequest;
use App\Models\Couple;
use App\Models\Month;
use App\Services\CoupleService;
use Carbon\Carbon;

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
            'couple' => $coupleService->getCouple($couple),
            'kb_services' => $coupleService->getAllKbServices(),
            'kb_statuses' => $coupleService->getKbStatuses($couple),
            'kb_anual_report' => $coupleService->getKbAnualReport($couple, $year),
            'months' => Month::all(),
            'current_month' => Carbon::now()->month,
            'current_year' => $year,
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
    public function update(UpdateCoupleRequest $request, Couple $couple, CoupleService $coupleService)
    {
        $coupleService->update($request, $couple);
        return redirect()->back();
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
