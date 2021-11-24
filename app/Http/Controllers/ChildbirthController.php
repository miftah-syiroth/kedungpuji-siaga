<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateChildbirthRequest;
use App\Models\BabyCondition;
use App\Models\BloodGroup;
use App\Models\Childbirth;
use App\Models\Disability;
use App\Models\Pregnancy;
use App\Models\Religion;
use App\Models\Sex;
use App\Services\ChildbirthService;
use Illuminate\Http\Request;

/**
 * ChildbirthController kelas ini digunakan untuk menambah penduduk dari kelahiran baru
 */
class ChildbirthController extends Controller
{
    private $childbirthService;

    public function __construct(ChildbirthService $service)
    {
        $this->childbirthService = $service;
        $this->middleware(['permission:hapus kelahiran'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('childbirths.index', [
            'childbirths' => $this->childbirthService->getNewBirths(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pregnancy $pregnancy)
    {
        #
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pregnancy $pregnancy)
    {
        if ($pregnancy->childbirth_date !== null) {
            $this->childbirthService->store($pregnancy);
            return redirect('/pregnancies/' . $pregnancy->id);
        } else {
            return redirect('/pregnancies/' . $pregnancy->id)->with('message', 'waktu kelahiran belum diisi!');
        }
        
        

        // baris ini adalah untuk menyipman penduduk dari kelahiran
        // StoreChildbirthRequest
        // $person = $this->childbirthService->store($request, $pregnancy);
        // return redirect('/people/' . $person->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Childbirth $childbirth)
    {
        return view('childbirths.edit', [
            'childbirth' => $childbirth,
            'sexes' => Sex::all(),
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
    public function update(UpdateChildbirthRequest $request, Childbirth $childbirth)
    {
        $this->childbirthService->update($request, $childbirth);
        return redirect('/pregnancies/' . $childbirth->pregnancy->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Childbirth $childbirth)
    {
        $pregnancy_id = $childbirth->pregnancy->id;
        $childbirth->delete();
        return redirect('/pregnancies/' . $pregnancy_id);
    }
}
