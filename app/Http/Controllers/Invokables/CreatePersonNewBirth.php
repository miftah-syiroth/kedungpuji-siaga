<?php

namespace App\Http\Controllers\Invokables;

use App\Http\Controllers\Controller;
use App\Models\BloodGroup;
use App\Models\Childbirth;
use App\Models\Disability;
use App\Models\Religion;
use Illuminate\Http\Request;

class CreatePersonNewBirth extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Childbirth $childbirth)
    {
        // kalau kelahiran udh punya relasi dgn person, cegah
        if (isset($childbirth->person)) {
            return redirect()->back();
        } else {
            return view('childbirths.create', [
                'childbirth' => $childbirth,
                'religions' => Religion::all(),
                'blood_groups' => BloodGroup::all(),
                'disabilities' => Disability::all(),
            ]);
        }
    }
}
