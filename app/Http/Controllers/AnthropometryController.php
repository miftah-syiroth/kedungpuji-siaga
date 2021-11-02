<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnthropometryRequest;
use App\Http\Requests\UpdateAnthropometryRequest;
use App\Models\Anthropometry;
use App\Models\Posyandu;
use App\Services\AnthropometryService;
use Illuminate\Http\Request;

class AnthropometryController extends Controller
{
    private $anthropometryService;

    public function __construct(AnthropometryService $service)
    {
        $this->anthropometryService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Posyandu $posyandu)
    {
        return view('posyandu.anthropometries.index', [
            'posyandu'=> Posyandu::with([
                // 'anthropometries',
                // 'anthropometries.bmiForAgeCategory',
                // 'anthropometries.heightForAgeCategory',
                // 'anthropometries.weightForAgeCategory',
                // 'anthropometries.weightForHeightCategory',
            ])->find($posyandu->id),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Posyandu $posyandu, $month)
    {
        return view('posyandu.anthropometries.create', [
            'posyandu' => $posyandu,
            'month' => $month,
            'current_time' => now(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnthropometryRequest $request, Posyandu $posyandu, $month)
    {
        $this->anthropometryService->store($request, $posyandu, $month);
        return redirect('/posyandu/' . $posyandu->id . '/anthropometries');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anthropometry  $anthropometry
     * @return \Illuminate\Http\Response
     */
    public function show(Anthropometry $anthropometry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anthropometry  $anthropometry
     * @return \Illuminate\Http\Response
     */
    public function edit(Anthropometry $anthropometry)
    {
        return view('posyandu.anthropometries.edit', [
            'anthropometry' => $anthropometry
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anthropometry  $anthropometry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnthropometryRequest $request, Anthropometry $anthropometry, AnthropometryService $service)
    {
        $service->update($request, $anthropometry);
        return redirect('/posyandu/' . $anthropometry->posyandu->id . '/anthropometries');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anthropometry  $anthropometry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anthropometry $anthropometry)
    {
        //
    }
}
