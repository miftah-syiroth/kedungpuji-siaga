<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePuerperalClassRequest;
use App\Models\Puerperal;
use App\Models\PuerperalClass;
use App\Services\PuerperalClassService;
use Illuminate\Http\Request;

class PuerperalClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Puerperal $puerperal, $periode, PuerperalClassService $service)
    {
        return view('puerperal-classes.create', [
            'puerperal' => $puerperal,
            'periode' => $periode,
            'waktu_awal' => $service->getWaktuAwal($puerperal->pregnancy->childbirth_date, $periode),
            'waktu_akhir' => $service->getWaktuAkhir($puerperal->pregnancy->childbirth_date, $periode),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePuerperalClassRequest $request, Puerperal $puerperal, PuerperalClassService $service)
    {
        $message = $service->store($request, $puerperal);
        return redirect('/puerperals/' . $puerperal->id)->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PuerperalClass  $puerperalClass
     * @return \Illuminate\Http\Response
     */
    public function show(PuerperalClass $puerperalClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PuerperalClass  $puerperalClass
     * @return \Illuminate\Http\Response
     */
    public function edit(PuerperalClass $puerperalClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PuerperalClass  $puerperalClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PuerperalClass $puerperalClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PuerperalClass  $puerperalClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(PuerperalClass $puerperalClass)
    {
        //
    }
}
