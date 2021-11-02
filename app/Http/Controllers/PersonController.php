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

class PersonController extends Controller
{
    private $personService;

    public function __construct(PersonService $service)
    {
        $this->personService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = request()->all();

        return view('people.index', [
            'people' => $this->personService->getPeople($filters),
            'sexes' => Sex::all(),
            'blood_groups' => BloodGroup::all(),
            'marital_statuses' => MaritalStatus::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
    public function store(StorePersonRequest $request)
    {
        $person = $this->personService->store($request);
        return redirect('/people/' . $person->id);
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
            'person' => $this->personService->getPerson($person), // tidak langsung karena butuh banyak eager loading
            'months' => Month::all(),
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
        return view('people.edit', [
            'person' => $person,
            'sexes' => Sex::all(),
            'religions' => Religion::all(),
            'blood_groups' => BloodGroup::all(),
            'educationals' => Educational::all(),
            'disabilities' => Disability::all(),
            'marital_statuses' => MaritalStatus::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonRequest $request, Person $person)
    {
        $this->personService->update($request, $person);
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
