<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Models\Person;
use App\Services\PersonService;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PersonService $personService)
    {
        $people = $personService->getAllPeople();

        return view('people.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PersonService $personService)
    {
        return view('people.create', [
            'sexes' => $personService->getSexes(),
            'religions' => $personService->getReligions(),
            'blood_groups' => $personService->getBloodGroups(),
            'educationals' => $personService->getEducationals(),
            'disabilities' => $personService->getDisabilities(),
            'marital_statuses' => $personService->getMaritalStatuses(),
            'family_statuses' => $personService->getFamilyStatuses(),
            'keluarga_sejahtera' => $personService->getKeluargaSejahtera(),
            'kb_services' => $personService->getKbServices(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersonRequest $request, PersonService $personService)
    {
        $personService->store($request);
        return redirect()->route('people.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return view('people.show', [
            'person' => $person,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }
}
