<?php

namespace App\Http\Controllers\Invokeables;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;

class DeadPerson extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Person $person)
    {
        $request->validate(['died_at' => 'required']);
        $person->update([
            'died_at' => $request->died_at,
        ]);

        return redirect('/people/' . $person->id);
    }
}
