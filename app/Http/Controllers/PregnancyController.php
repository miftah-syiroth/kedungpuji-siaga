<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewPregnancyRequest;
use App\Http\Requests\StorePregnancyRequest;
use App\Http\Requests\UpdatePregnancyRequest;
use App\Models\BabyCondition;
use App\Models\Person;
use App\Models\Pregnancy;
use App\Models\Sex;
use App\Services\PregnancyService;

class PregnancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PregnancyService $pregnancyService)
    {
        // dd($pregnancyService->getAllPregnancies());
        return view('pregnancies.index', [
            'pregnancies' => $pregnancyService->getAllPregnancies(),
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
    public function store(StorePregnancyRequest $request, PregnancyService $pregnancyService)
    {
        $pregnancy = $pregnancyService->store($request);

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
    public function show(Pregnancy $pregnancy, PregnancyService $pregnancyService)
    {
        return view('pregnancies.show', [
            'pregnancy' => $pregnancy,
            'age_in_months' => $pregnancy->hpht->diffInMonths(now()) + 1,
            'age_in_weeks' => $pregnancy->hpht->diffInWeeks(now()),
            'age_in_days' => $pregnancy->hpht->diffInDays(now()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pregnancy $pregnancy)
    {
        return view('pregnancies.edit', [
            'pregnancy' => $pregnancy,
            'awal_waktu' => $pregnancy->hpht->addWeeks(28), // batas input waktu persalinan
            'akhir_waktu' => $pregnancy->hpht->addWeeks(42), // batas input waktu persalinan
            'sexes' => Sex::all(),
            'baby_conditions' => BabyCondition::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePregnancyRequest $request, Pregnancy $pregnancy, PregnancyService $service)
    {
        $is_success = $service->update($request, $pregnancy);

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
    public function destroy($id)
    {
        //
    }
}
