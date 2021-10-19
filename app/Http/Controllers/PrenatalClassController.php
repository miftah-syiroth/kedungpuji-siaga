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
    public function create(Pregnancy $pregnancy, $month)
    {
        // cek disini apakah tgl persalinan udh diisi atau udh hamil, maka cegah input laporan baru
        if ($pregnancy->childbirth_date != null) {
            return redirect('/pregnancies/' . $pregnancy->id);
        } elseif ($pregnancy->childbirth_date == null) {
            return view('prenatal-classes.create', [
                'pregnancy' => $pregnancy,
                'month' => $month,
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
        $service->store($request, $pregnancy);
        return redirect('/pregnancies/' . $pregnancy->id);
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
        $service->update($request, $prenatalClass);
        return redirect('/pregnancies/' . $prenatalClass->pregnancy->id);
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
