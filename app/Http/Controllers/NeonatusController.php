<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNeonatusRequest;
use App\Http\Requests\UpdateNeonatusRequest;
use App\Models\Neonatus;
use App\Models\Person;
use App\Models\Posyandu;
use App\Services\NeonatusService;

class NeonatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Person $person)
    {
        return view('neonatuses.index', [
            'person' => $person,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Posyandu $posyandu, $periode, NeonatusService $service)
    {
        // batasi kalau posyandu neonatus dgn periode tsb sudah ada, maka batalkan
        $row = $posyandu->neonatuses()->where('periode', $periode)->first();

        if (empty($row)) {
            return view('neonatuses.create', [
                'posyandu' => $posyandu,
                'periode' => $periode,
                'waktu_awal' => $service->getWaktuAwal($posyandu->person->date_of_birth, $periode),
                'waktu_akhir' => $service->getWaktuAkhir($posyandu->person->date_of_birth, $periode),
            ]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNeonatusRequest $request, Posyandu $posyandu, NeonatusService $service)
    {
        $is_success = $service->store($request, $posyandu);

        if ($is_success == true) {
            return redirect('/posyandu/' . $posyandu->id);
        } else {
            return redirect()->back()->with('message', 'masukkan waktu kunjungan yg sesuai dengan batasan KN');
        }
        
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
    public function edit(Neonatus $neonatus, NeonatusService $service)
    {
        return view('neonatuses.edit', [
            'neonatus' => $neonatus,
            'waktu_awal' => $service->getWaktuAwal($neonatus->posyandu->person->date_of_birth, $neonatus->periode),
            'waktu_akhir' => $service->getWaktuAkhir($neonatus->posyandu->person->date_of_birth, $neonatus->periode),
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
        $is_success = $service->update($request, $neonatus);

        if ($is_success == true) {
            return redirect('/posyandu/' . $neonatus->posyandu->id);
        } else {
            return redirect()->back()->with('message', 'masukkan waktu kunjungan yg sesuai dengan batasan KN');
        }
        
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
