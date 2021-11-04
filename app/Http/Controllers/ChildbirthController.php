<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChildbirthRequest;
use App\Models\BloodGroup;
use App\Models\Disability;
use App\Models\Pregnancy;
use App\Models\Religion;
use App\Services\ChildbirthService;
use Illuminate\Http\Request;

/**
 * ChildbirthController kelas ini digunakan untuk menambah penduduk dari kelahiran baru
 */
class ChildbirthController extends Controller
{
    private $childbirthService;

    public function __construct(ChildbirthService $service)
    {
        $this->childbirthService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('childbirths.index', [
            'childbirths' => $this->childbirthService->getNewBirths(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pregnancy $pregnancy)
    {
        // kalau pregnancy udh punya relasi dgn person, cegah
        if (isset($pregnancy->baby)) {
            return redirect()->back();
        } else {
            return view('childbirths.create', [
                'pregnancy' => $pregnancy,
                'religions' => Religion::all(),
                'blood_groups' => BloodGroup::all(),
                'disabilities' => Disability::all(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChildbirthRequest $request, Pregnancy $pregnancy)
    {
        $person = $this->childbirthService->store($request, $pregnancy);
        return redirect('/people/' . $person->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
