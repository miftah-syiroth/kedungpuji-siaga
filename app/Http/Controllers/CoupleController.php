<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteCoupleRequest;
use App\Http\Requests\StoreCoupleRequest;
use App\Http\Requests\UpdateCoupleRequest;
use App\Models\Couple;
use App\Models\KbService;
use App\Services\CoupleService;

class CoupleController extends Controller
{
    private $coupleService;

    public function __construct(CoupleService $service)
    {
        $this->coupleService = $service;
        $this->middleware(['permission:hapus pasangan'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = request()->all();

        return view('couples.index', [
            'couples' => $this->coupleService->getCouples($filters),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('couples.create', [
            'kb_services' => KbService::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoupleRequest $request)
    {
        $couple = $this->coupleService->store($request);
        return redirect('/couples/' . $couple->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function show(Couple $couple)
    {
        return view('couples.show', [
            'couple' => $couple,
            'cerai_statuses' => $this->coupleService->getCeraiStatuses(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function edit(Couple $couple)
    {
        return view('couples.edit', [
            'couple' => $couple,
            'cerai_statuses' => $this->coupleService->getCeraiStatuses(),
            'kb_services' => KbService::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoupleRequest $request, Couple $couple)
    {
        $this->coupleService->update($request, $couple);
        return redirect('/couples/' . $couple->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteCoupleRequest $request, Couple $couple)
    {
        $this->coupleService->softDelete($request, $couple);
        return redirect('/couples');
    }
}
