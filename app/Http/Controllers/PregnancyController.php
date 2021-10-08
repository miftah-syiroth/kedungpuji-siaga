<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewPregnancyRequest;
use App\Models\Person;
use App\Models\Pregnancy;
use App\Services\PregnancyService;
use Illuminate\Http\Request;

class PregnancyController extends Controller
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
    public function create(Person $person)
    {
        return view('pregnancies.create', [
            'mother' => $person,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewPregnancyRequest $request, Person $person, PregnancyService $pregnancyService)
    {
        $pregnancyService->store($request, $person);
        return redirect('/people/' . $person->id);
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
            'kb_status' => $pregnancyService->getKbAfterChildbirth($pregnancy)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNewPregnancyRequest $request, Pregnancy $pregnancy, )
    {
        
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
