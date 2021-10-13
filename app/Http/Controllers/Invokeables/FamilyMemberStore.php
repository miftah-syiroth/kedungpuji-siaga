<?php

namespace App\Http\Controllers\Invokeables;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFamilyMemberRequest;
use App\Models\Family;
use App\Services\FamilyService;

class FamilyMemberStore extends Controller
{
    /**
     * ini adalah fitur untuk menambahkan penduduk baru (family_id == null) ke sebuah keluarga melalui halaman show family
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreFamilyMemberRequest $request, Family $family, FamilyService $familyService)
    {
        $familyService->addFamilyMember($request, $family);
        return redirect('/families/' . $family->id);
    }
}
