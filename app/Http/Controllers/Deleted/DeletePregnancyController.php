<?php

namespace App\Http\Controllers\Deleted;

use App\Http\Controllers\Controller;
use App\Services\PregnancyService;
use Illuminate\Http\Request;

class DeletePregnancyController extends Controller
{
    private $pregnancyService;

    public function __construct(PregnancyService $service)
    {
        $this->pregnancyService = $service;
    }

    public function index()
    {
        return view('deleted-models.deleted-pregnancies', [
            'pregnancies' => $this->pregnancyService->getDeletedPregnancies(),
        ]);
    }

    public function restore(Request $request, $pregnancy)
    {
        $this->pregnancyService->restore($pregnancy);
        return redirect('/deleted/pregnancies')->with('message', 'Berhasil dikembalikan');
    }

    public function destroy($pregnancy)
    {
        $this->pregnancyService->deletePermanently($pregnancy);
        return redirect('/deleted/pregnancies')->with('message', 'Berhasil dihapus permanen');
    }
}
