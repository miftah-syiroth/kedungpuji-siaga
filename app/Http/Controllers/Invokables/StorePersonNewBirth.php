<?php

namespace App\Http\Controllers\Invokables;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChildbirthRequest;
use App\Models\Childbirth;
use App\Services\ChildbirthService;

class StorePersonNewBirth extends Controller
{
    private $childbirthService;

    public function __construct(ChildbirthService $service)
    {
        $this->childbirthService = $service;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreChildbirthRequest $request, Childbirth $childbirth)
    {
        $person = $this->childbirthService->storePersonNewBirth($request, $childbirth);
        return redirect('/people/' . $person->id);
    }
}
