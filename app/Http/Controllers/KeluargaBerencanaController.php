<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKeluargaBerencanaRequest;
use App\Models\KbService;
use App\Models\KeluargaBerencana;
use App\Models\Month;
use App\Services\CoupleService;
use App\Services\KbService as ServicesKbService;
use App\Services\KeluargaBerencanaService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KeluargaBerencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServicesKbService $kbService)
    {
        return view('keluarga-berencana.index', [
            'couples' => $kbService->getAllCouplesWithKbReport(),
            'months' => Month::all(),
            // 'year' => Carbon::now()->year,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        # code ...
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeluargaBerencana  $keluargaBerencana
     * @return \Illuminate\Http\Response
     */
    public function show(KeluargaBerencana $keluargaBerencana)
    {
        return view('keluarga-berencana.show', [
            'keluarga_berencana' => $keluargaBerencana,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KeluargaBerencana  $keluargaBerencana
     * @return \Illuminate\Http\Response
     */
    public function edit(KeluargaBerencana $keluargaBerencana)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KeluargaBerencana  $keluargaBerencana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeluargaBerencana $keluargaBerencana)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeluargaBerencana  $keluargaBerencana
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeluargaBerencana $keluargaBerencana)
    {
        //
    }
}
