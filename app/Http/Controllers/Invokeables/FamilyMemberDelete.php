<?php

namespace App\Http\Controllers\Invokeables;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\Person;
use App\Services\FamilyService;
use Illuminate\Http\Request;

class FamilyMemberDelete extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Family $family, Person $person, FamilyService $familyService)
    {
        $familyService->removeFamilyMember($family, $person);
        return redirect('/families/' . $family->id);
    }
}
