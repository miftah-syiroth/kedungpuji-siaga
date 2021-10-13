<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFamilyRequest;
use App\Http\Requests\UpdateFamilyRequest;
use App\Models\Family;
use App\Models\KeluargaSejahtera;
use App\Services\FamilyService;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FamilyService $familyService)
    {
        return view('families.index', [
            'families' => $familyService->getAllFamilies(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FamilyService $familyService)
    {
        return view('families.create', [
            'keluarga_sejahtera' => $familyService->getAllKeluargaSejahtera(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFamilyRequest $request, FamilyService $familyService)
    {
        $family = $familyService->store($request);
        return redirect('/families/' . $family->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, FamilyService $familyService)
    {
        return view('families.show', [
            'family' => $familyService->getFamily($family),
            'family_statuses' => $familyService->getFamilyStatuses(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        return view('families.edit', [
            'family' => $family,
            'keluarga_sejahtera' => KeluargaSejahtera::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFamilyRequest $request, Family $family, FamilyService $familyService)
    {
        $familyService->update($request, $family);
        return redirect('/families/' . $family->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family, FamilyService $familyService)
    {
        $familyService->destroy($family);
        return redirect('/families');
    }
}
