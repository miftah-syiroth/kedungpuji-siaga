<?php

namespace App\Http\Controllers\Deleted;

use App\Http\Controllers\Controller;
use App\Services\PersonService;
use Illuminate\Http\Request;

class DeletePersonController extends Controller
{
    private $personService;

    public function __construct(PersonService $service)
    {
        $this->personService = $service;
    }

    public function index()
    {
        return view('deleted-models.deleted-people', [
            'people' => $this->personService->getDeletedPeople(),
        ]);
    }

    public function restore(Request $request, $person)
    {
        $this->personService->restore($person);
        return redirect('/deleted/people')->with('message', 'Berhasil dikembalikan');
    }

    public function destroy($person)
    {
        $this->personService->forceDelete($person);
        return redirect('/deleted/people')->with('message', 'Berhasil dihapus permanen');
    }
}
