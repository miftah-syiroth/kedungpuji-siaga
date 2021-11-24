<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFamilyRequest;
use App\Http\Requests\UpdateFamilyRequest;
use App\Models\Family;
use App\Models\FamilyStatus;
use App\Models\KeluargaSejahtera;
use App\Services\FamilyService;

class FamilyController extends Controller
{
    private $familyService;

    public function __construct(FamilyService $service)
    {
        $this->familyService = $service;
        $this->middleware(['permission:hapus keluarga'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = request()->all();

        return view('families.index', [
            'families' => $this->familyService->getAllFamilies($filters),
            'keluarga_sejahtera' => KeluargaSejahtera::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('families.create', [
            'keluarga_sejahtera' => KeluargaSejahtera::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFamilyRequest $request)
    {
        $family = $this->familyService->store($request);
        return redirect('/families/' . $family->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        return view('families.show', [
            'family' => $this->familyService->getFamily($family->id),
            'family_statuses' => FamilyStatus::whereNotIn('id', [1])->get(),
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
    public function update(UpdateFamilyRequest $request, Family $family)
    {
        $this->familyService->update($request, $family);
        return redirect('/families/' . $family->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        $this->familyService->destroy($family);
        return redirect('/families');
    }
}
