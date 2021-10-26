<?php
namespace App\Services;

use App\Models\Person;
use App\Models\Pregnancy;

class ChildbirthService
{    
    public function getNewBirths()
    {
        # ambil semua baris pregnancy, yang waktu persalinan sudah diisi dan ga punya relasi ke person
        return Pregnancy::doesntHave('baby')->whereNotNull('childbirth_date')->get();
    }

    public function store($request, $pregnancy)
    {
        $attributes = $request->all();
        
        $attributes['sex_id'] = $pregnancy->sex_id;
        $attributes['date_of_birth'] = $pregnancy->childbirth_date;
        $attributes['educational_id'] = 1; // tidak/belum sekolah
        $attributes['marital_status_id'] = 1; //belum kawin
        $attributes['ibu_id'] = $pregnancy->mother_id;

        // cek kalau ga ada input ayah, ambil ayah dari suami ibu
        if ($request->missing('ayah_id')) {
            if (isset($pregnancy->mother->husband)) {
                $attributes['ayah_id'] = $pregnancy->mother->husband->suami_id;
            }
        }

        $person = Person::create($attributes);
        $pregnancy->baby()->associate($person)->save();

        return $person;
    }
}
