<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrenatalClassRequest;
use App\Http\Requests\UpdatePrenatalClassRequest;
use App\Models\Pregnancy;
use App\Models\PrenatalClass;
use App\Services\PrenatalClassService;

class PrenatalClassController extends Controller
{
    private $service;

    public function __construct(PrenatalClassService $service)
    {
        $this->service = $service;
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
    public function create(Pregnancy $pregnancy, $month)
    {
        // cek disini apakah tgl persalinan udh diisi atau udh hamil, maka cegah input laporan baru
        // if ($pregnancy->childbirth_date != null) {
        //     return redirect('/pregnancies/' . $pregnancy->id);
        // } 

        // tidak boleh input untuk masa depan
        if ($month > $pregnancy->hpht->diffInMonths(now()) + 1) {
            return redirect('/pregnancies/' . $pregnancy->id);
        }

        // cek barangkali data pd bulan tsb sudah diinputkan, maka cegah
        $dataInThisMonth = $pregnancy->prenatalClasses()->where('month_periode', $month)->first();
        if (isset($dataInThisMonth)) {
            return redirect('/pregnancies/' . $pregnancy->id);
        }

        return view('prenatal-classes.create', [
            'pregnancy' => $pregnancy,
            'month' => $month,
            'waktu_awal' => $this->service->getWaktuAwal($pregnancy->hpht, $month),
            'waktu_akhir' => $this->service->getWaktuAkhir($pregnancy->hpht, $month),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrenatalClassRequest $request, Pregnancy $pregnancy, $month)
    {
        $is_success = $this->service->store($request, $pregnancy, $month);
        if ($is_success == true) {
            return redirect('/pregnancies/' . $pregnancy->id);
        } else {
            return redirect()->back()->with('message', 'masukkan waktu kunjungan yang sesuai');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PrenatalClass  $prenatalClass
     * @return \Illuminate\Http\Response
     */
    public function show(PrenatalClass $prenatalClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrenatalClass  $prenatalClass
     * @return \Illuminate\Http\Response
     */
    public function edit(PrenatalClass $prenatalClass)
    {
        return view('prenatal-classes.edit', [
            'prenatal_class' => $prenatalClass,
            'waktu_awal' => $this->service->getWaktuAwal($prenatalClass->pregnancy->hpht, $prenatalClass->month_periode),
            'waktu_akhir' => $this->service->getWaktuAkhir($prenatalClass->pregnancy->hpht, $prenatalClass->month_periode),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PrenatalClass  $prenatalClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrenatalClassRequest $request, PrenatalClass $prenatalClass)
    {
        $is_success = $this->service->update($request, $prenatalClass);
        if ($is_success == true) {
            return redirect('/pregnancies/' . $prenatalClass->pregnancy->id);
        } else {
            return redirect()->back()->with('message', 'masukkan waktu kunjungan yang sesuai');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrenatalClass  $prenatalClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrenatalClass $prenatalClass)
    {
        //
    }
}
