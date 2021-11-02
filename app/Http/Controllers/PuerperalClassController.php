<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePuerperalClassRequest;
use App\Http\Requests\UpdatePuerperalClassRequest;
use App\Models\Puerperal;
use App\Models\PuerperalClass;
use App\Services\PuerperalClassService;
use Illuminate\Http\Request;

class PuerperalClassController extends Controller
{
    private $service;

    public function __construct(PuerperalClassService $service)
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
    public function create(Puerperal $puerperal, $periode)
    {
        return view('puerperal-classes.create', [
            'puerperal' => $puerperal,
            'periode' => $periode,
            'waktu_awal' => $this->service->getWaktuAwal($puerperal->pregnancy->childbirth_date, $periode),
            'waktu_akhir' => $this->service->getWaktuAkhir($puerperal->pregnancy->childbirth_date, $periode),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePuerperalClassRequest $request, Puerperal $puerperal, $periode)
    {
        $is_success = $this->service->store($request, $puerperal, $periode);

        if ($is_success == true) {
            return redirect('/puerperals/' . $puerperal->id)->with('message', 'berhasil');
        } else {
            return redirect()->back()->with('message', 'gagal');
        }
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
        return view('puerperal-classes.edit', [
            'puerperal_class' => $puerperalClass,
            'waktu_awal' => $this->service->getWaktuAwal($puerperalClass->puerperal->pregnancy->childbirth_date, $puerperalClass->periode),
            'waktu_akhir' => $this->service->getWaktuAkhir($puerperalClass->puerperal->pregnancy->childbirth_date, $puerperalClass->periode),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PuerperalClass  $puerperalClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePuerperalClassRequest $request, PuerperalClass $puerperalClass)
    {
        $is_success = $this->service->update($request, $puerperalClass);

        if ($is_success == true) {
            return redirect('/puerperals/' . $puerperalClass->puerperal->id)->with('message', 'berhasil');
        } else {
            return redirect()->back()->with('message', 'gagal');
        }
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
