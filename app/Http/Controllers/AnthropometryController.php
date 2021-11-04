<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnthropometryRequest;
use App\Http\Requests\UpdateAnthropometryRequest;
use App\Models\Anthropometry;
use App\Models\Posyandu;
use App\Services\AnthropometryService;
use Illuminate\Http\Request;

class AnthropometryController extends Controller
{
    private $anthropometryService;

    public function __construct(AnthropometryService $service)
    {
        $this->anthropometryService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Posyandu $posyandu)
    {
        return view('posyandu.anthropometries.index', [
            'posyandu'=> Posyandu::with([
                // 'anthropometries',
                // 'anthropometries.bmiForAgeCategory',
                // 'anthropometries.heightForAgeCategory',
                // 'anthropometries.weightForAgeCategory',
                // 'anthropometries.weightForHeightCategory',
            ])->find($posyandu->id),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Posyandu $posyandu, $month)
    {
        // batasi kalau posyandu antropometri dgn periode bulan tsb sudah ada, maka batalkan
        $row = $posyandu->anthropometries()->where('month_periode', $month)->first();

        if (empty($row)) {
            return view('posyandu.anthropometries.create', [
                'posyandu' => $posyandu,
                'month' => $month,
                'waktu_awal' => $posyandu->person->date_of_birth->addMonths($month),
                'waktu_akhir' => $posyandu->person->date_of_birth->addMonths($month+1),
            ]);
        } else {
            return redirect('/posyandu/' . $posyandu->id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnthropometryRequest $request, Posyandu $posyandu, $month)
    {
        $is_success = $this->anthropometryService->store($request, $posyandu, $month);

        if ($is_success == true) {
            return redirect('/posyandu/' . $posyandu->id);
        } else {
            return redirect()->back()->with('message', 'masukkan waktu kunjungan yg sesuai dengan batasan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anthropometry  $anthropometry
     * @return \Illuminate\Http\Response
     */
    public function show(Anthropometry $anthropometry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anthropometry  $anthropometry
     * @return \Illuminate\Http\Response
     */
    public function edit(Anthropometry $anthropometry)
    {
        return view('posyandu.anthropometries.edit', [
            'anthropometry' => $anthropometry,
            'waktu_awal' => $anthropometry->posyandu->person->date_of_birth->addMonths($anthropometry->month_periode),
            'waktu_akhir' => $anthropometry->posyandu->person->date_of_birth->addMonths($anthropometry->month_periode + 1),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anthropometry  $anthropometry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnthropometryRequest $request, Anthropometry $anthropometry, AnthropometryService $service)
    {
        $is_success = $service->update($request, $anthropometry);

        if ($is_success == true) {
            return redirect('/posyandu/' . $anthropometry->posyandu->id);
        } else {
            return redirect()->back()->with('message', 'gagal');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anthropometry  $anthropometry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anthropometry $anthropometry)
    {
        //
    }
}
