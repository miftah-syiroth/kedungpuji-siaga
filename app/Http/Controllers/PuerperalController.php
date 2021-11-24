<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePuerperalRequest;
use App\Models\BabyCondition;
use App\Models\MotherCondition;
use App\Models\Pregnancy;
use App\Models\Puerperal;
use App\Models\PuerperalComplication;
use App\Services\PuerperalService;
use Illuminate\Http\Request;

class PuerperalController extends Controller
{
    private $puerperalService;

    public function __construct(PuerperalService $service)
    {
        $this->puerperalService = $service;
        $this->middleware(['permission:hapus nifas'])->only('destroy');
    }

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
    public function store(Request $request, Pregnancy $pregnancy)
    {
        $pregnancy->puerperal()->create();
        return redirect('/pregnancies/' . $pregnancy->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Puerperal  $puerperal
     * @return \Illuminate\Http\Response
     */
    public function show(Puerperal $puerperal)
    {
        return view('puerperals.show', [
            'puerperal' => $puerperal,
            'periode' => $this->puerperalService->getPeriode(),
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
            'baby_conditions' => BabyCondition::whereIn('id', [7, 8, 9, 10])->get(),
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
    public function update(UpdatePuerperalRequest $request, Puerperal $puerperal)
    {
        $this->puerperalService->update($request, $puerperal);
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
        $this->puerperalService->softDelete($puerperal);
        return redirect('/pregnancies');
    }
}
