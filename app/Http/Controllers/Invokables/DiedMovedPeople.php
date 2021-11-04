<?php

namespace App\Http\Controllers\Invokables;

use App\Http\Controllers\Controller;
use App\Models\BloodGroup;
use App\Models\MaritalStatus;
use App\Models\Sex;
use App\Services\PersonService;
use Illuminate\Http\Request;

class DiedMovedPeople extends Controller
{
    private $personService;

    public function __construct(PersonService $service)
    {
        $this->personService = $service;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $filters = request()->all();

        return view('people.moved-or-died', [
            'people' => $this->personService->getPeopleDeadOrMoved($filters),
            'sexes' => Sex::all(),
            'blood_groups' => BloodGroup::all(),
            'marital_statuses' => MaritalStatus::all(),
        ]);
    }
}
