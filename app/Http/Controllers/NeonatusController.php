<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNeonatusRequest;
use App\Http\Requests\UpdateNeonatusRequest;
use App\Models\Neonatus;
use App\Models\Posyandu;
use App\Services\NeonatusService;

class NeonatusController extends Controller
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
    public function create(Posyandu $posyandu, $periode)
    {
        return view('neonatuses.create', [
            'posyandu' => $posyandu,
            'periode' => $periode,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNeonatusRequest $request, Posyandu $posyandu, NeonatusService $service)
    {
        $message = $service->store($request, $posyandu);
        return redirect('/posyandu/' . $posyandu->id)->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Neonatus  $neonatus
     * @return \Illuminate\Http\Response
     */
    public function show(Neonatus $neonatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Neonatus  $neonatus
     * @return \Illuminate\Http\Response
     */
    public function edit(Neonatus $neonatus)
    {
        return view('neonatuses.edit', [
            'neonatus' => $neonatus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Neonatus  $neonatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNeonatusRequest $request, Neonatus $neonatus, NeonatusService $service)
    {
        $service->update($request, $neonatus);
        return redirect('/posyandu/' . $neonatus->posyandu->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Neonatus  $neonatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Neonatus $neonatus)
    {
        //
    }
}
