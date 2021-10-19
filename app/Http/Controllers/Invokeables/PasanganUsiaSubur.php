<?php

namespace App\Http\Controllers\Invokeables;

use App\Http\Controllers\Controller;
use App\Services\CoupleService;
use Illuminate\Http\Request;

class PasanganUsiaSubur extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CoupleService $coupleService)
    {
        return view('couples.pus', [
            'couples' => $coupleService->getPus(),
        ]);
    }
}
