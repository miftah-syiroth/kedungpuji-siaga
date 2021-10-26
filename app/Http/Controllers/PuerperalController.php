<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePuerperalRequest;
use App\Models\BabyCondition;
use App\Models\MotherCondition;
use App\Models\Puerperal;
use App\Models\PuerperalComplication;
use App\Services\PuerperalService;
use Illuminate\Http\Request;

class PuerperalController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Puerperal  $puerperal
     * @return \Illuminate\Http\Response
     */
    public function show(Puerperal $puerperal)
    {
        $periode = [
            ['nomor' => 1, 'min' => '0', 'max' => '6 jam'], // 0-6 jam
            ['nomor' => 2, 'min' => '6', 'max' => '48 jam'], //6-48 jam
            ['nomor' => 3, 'min' => '3', 'max' => '7 hari'], //3-7 hari
            ['nomor' => 4, 'min' => '8', 'max' => '48 hari'], //8-28 hari
        ];

        return view('puerperals.show', [
            'puerperal' => $puerperal,
            'periode' => $periode,
            'puerperal_day_to' => $puerperal->pregnancy->childbirth_date->diffInDays(now()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Puerperal  $puerperal
     * @return \Illuminate\Http\Response
     */
    public function edit(Puerperal $puerperal)
    {
        return view('puerperals.edit', [
            'puerperal' => $puerperal,
            'mother_conditions' => MotherCondition::all(),
            'baby_conditions' => BabyCondition::all(),
            'complications' => PuerperalComplication::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Puerperal  $puerperal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePuerperalRequest $request, Puerperal $puerperal, PuerperalService $service)
    {
        $service->update($request, $puerperal);
        return redirect('/puerperals/' . $puerperal->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Puerperal  $puerperal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puerperal $puerperal)
    {
        //
    }
}
