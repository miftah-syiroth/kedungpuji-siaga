<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrenatalClassRequest;
use App\Http\Requests\UpdatePrenatalClassRequest;
use App\Models\Pregnancy;
use App\Models\PrenatalClass;
use App\Services\PrenatalClassService;
use Illuminate\Http\Request;

class PrenatalClassController extends Controller
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
    public function create(Pregnancy $pregnancy, $month, PrenatalClassService $service)
    {
        // cek disini apakah tgl persalinan udh diisi atau udh hamil, maka cegah input laporan baru
        if ($pregnancy->childbirth_date != null) {
            return redirect('/pregnancies/' . $pregnancy->id);
        } elseif ($pregnancy->childbirth_date == null) {
            return view('prenatal-classes.create', [
                'pregnancy' => $pregnancy,
                'month' => $month,
                'waktu_awal' => $service->getWaktuAwal($pregnancy->hpht, $month),
                'waktu_akhir' => $service->getWaktuAkhir($pregnancy->hpht, $month),
            ]);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrenatalClassRequest $request, Pregnancy $pregnancy, PrenatalClassService $service)
    {
        $is_success = $service->store($request, $pregnancy);
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
    public function edit(PrenatalClass $prenatalClass, PrenatalClassService $service)
    {
        return view('prenatal-classes.edit', [
            'prenatal_class' => $prenatalClass,
            'waktu_awal' => $service->getWaktuAwal($prenatalClass->pregnancy->hpht, $prenatalClass->month_periode),
            'waktu_akhir' => $service->getWaktuAkhir($prenatalClass->pregnancy->hpht, $prenatalClass->month_periode),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PrenatalClass  $prenatalClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrenatalClassRequest $request, PrenatalClass $prenatalClass, PrenatalClassService $service)
    {
        $is_success = $service->update($request, $prenatalClass);
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
