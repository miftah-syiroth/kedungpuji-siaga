<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrenatalClassRequest;
use App\Models\Pregnancy;
use App\Models\PrenatalClass;
use App\Services\PrenatalClassService;
use Illuminate\Http\Request;

class PrenatalClassController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrenatalClassRequest $request, Pregnancy $pregnancy, PrenatalClassService $service)
    {
        // dd($pregnancy);
        $service->store($request, $pregnancy);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PrenatalClass  $prenatalClass
     * @return \Illuminate\Http\Response
     */
    public function show(PrenatalClass $prenatalClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrenatalClass  $prenatalClass
     * @return \Illuminate\Http\Response
     */
    public function edit(PrenatalClass $prenatalClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PrenatalClass  $prenatalClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrenatalClass $prenatalClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrenatalClass  $prenatalClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrenatalClass $prenatalClass)
    {
        //
    }
}
