<?php
namespace App\Services;

use App\Models\Person;

class PersonService
{
    public function getAllPeople()
    {
        return Person::with(['sex', 'bloodGroup', 'maritalStatus', 'family', 'familyStatus'])->get();
    }
}
