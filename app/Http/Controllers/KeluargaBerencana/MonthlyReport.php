<?php

namespace App\Http\Controllers\KeluargaBerencana;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKbRequest;
use App\Models\Couple;
use App\Models\KeluargaBerencana;
use App\Services\KbService;

class MonthlyReport extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreKbRequest $request, Couple $couple, KbService $kbService)
    {
        $kbService->store($request, $couple);
        
        return redirect()->back();
    }
}
