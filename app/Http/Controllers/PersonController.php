<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\BloodGroup;
use App\Models\Disability;
use App\Models\Educational;
use App\Models\MaritalStatus;
use App\Models\Month;
use App\Models\Person;
use App\Models\Religion;
use App\Models\Sex;
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
            'sexes' => Sex::all(),
            'religions' => Religion::all(),
            'blood_groups' => BloodGroup::all(),
            'educationals' => Educational::all(),
            'disabilities' => Disability::all(),
            'marital_statuses' => MaritalStatus::all(),
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
        $person = $personService->storePerson($request);
        return redirect('/people/' . $person->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person, PersonService $personService)
    {
        return view('people.show', [
            'person' => $personService->getPerson($person), // tidak langsung karena butuh banyak eager loading
            'months' => Month::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person, PersonService $personService)
    {
        return view('people.edit', [
            'person' => $person,
            'sexes' => $personService->getSexes(),
            'religions' => $personService->getReligions(),
            'blood_groups' => $personService->getBloodGroups(),
            'educationals' => $personService->getEducationals(),
            'disabilities' => $personService->getDisabilities(),
            'marital_statuses' => $personService->getMaritalStatuses(),
            // 'family_statuses' => $personService->getFamilyStatuses(),
            // 'keluarga_sejahtera' => $personService->getKeluargaSejahtera(),
            // 'kb_services' => $personService->getKbServices(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonRequest $request, Person $person, PersonService $personService)
    {
        $personService->update($request, $person);
        return redirect('/people/' . $person->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return redirect('/people');
    }
}
