<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewPregnancyRequest;
use App\Http\Requests\StorePregnancyRequest;
use App\Http\Requests\UpdatePregnancyRequest;
use App\Models\BabyCondition;
use App\Models\Month;
use App\Models\MotherCondition;
use App\Models\Person;
use App\Models\Pregnancy;
use App\Models\Sex;
use App\Services\PregnancyService;

class PregnancyController extends Controller
{
    private $pregnancyService;

    public function __construct(PregnancyService $service)
    {
        $this->pregnancyService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = request()->all();
        return view('pregnancies.index', [
            'months' => Month::all(),
            'pregnancies' => $this->pregnancyService->getAllPregnancies($filters),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pregnancies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePregnancyRequest $request)
    {
        $pregnancy = $this->pregnancyService->store($request);

        if (empty($pregnancy)) {
            return redirect('/pregnancies/create')->with('message', 'ibu belum melahirkan atau belum selesai Nifas');
        } else {
            return redirect('/pregnancies/' . $pregnancy->id);
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pregnancy $pregnancy)
    {
        return view('pregnancies.show', [
            'pregnancy' => $pregnancy,
        ]);
    }

    /**
     * trimester 3 adalah 28 s.d. 42 pekan. 
     * awal_waktu adalah tgl pada pekan ke 28
     * akhir_waktu adalah tgl pada pekan ke 42
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pregnancy $pregnancy)
    {
        return view('pregnancies.edit', [
            'pregnancy' => $pregnancy,
            'sexes' => Sex::all(),
            'mother_conditions' => MotherCondition::all(),
            'baby_conditions' => BabyCondition::whereNotIn('id', [9, 10])->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePregnancyRequest $request, Pregnancy $pregnancy)
    {
        $is_success = $this->pregnancyService->update($request, $pregnancy);

        if ($is_success == true) {
            return redirect('/pregnancies/' . $pregnancy->id);
        } else {
            return redirect()->back()->with('message', 'masukkan batas waktu persalinan dengan benar!');
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pregnancy $pregnancy)
    {
        $this->pregnancyService->softDelete($pregnancy);
        return redirect('/pregnancies');
    }
}
