<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;
use App\Models\Person;
use App\Models\Posyandu;
use App\Models\Sex;
use App\Services\PosyanduService;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    private $posyanduService;

    public function __construct(PosyanduService $service)
    {
        $this->posyanduService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = request()->all();
        return view('posyandu.index', [
            'people' => $this->posyanduService->getAllBalita($filters),
            'sexes' => Sex::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        # code ..
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Person $person)
    {
        // request belum dicustom
        $posyandu = $this->posyanduService->store($request, $person);
        return redirect('/posyandu/' . $posyandu->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posyandu  $posyandu
     * @return \Illuminate\Http\Response
     */
    public function show(Posyandu $posyandu)
    {
        return view('posyandu.show', [
            'posyandu' => $posyandu,
            'umur_bayi' => $posyandu->person->date_of_birth->diffInDays(now()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posyandu  $posyandu
     * @return \Illuminate\Http\Response
     */
    public function edit(Posyandu $posyandu)
    {
        return view('posyandu.edit', [
            'posyandu' => $posyandu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posyandu  $posyandu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posyandu $posyandu)
    {
        $posyandu->update($request->all());
        return redirect('/posyandu/' . $posyandu->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posyandu  $posyandu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posyandu $posyandu)
    {
        $this->posyanduService->softDelete($posyandu);
        return redirect('/posyandu');
    }
}
