<?php

namespace App\Http\Controllers\Deleted;

use App\Http\Controllers\Controller;
use App\Services\ChildbirthService;
use Illuminate\Http\Request;

class DeleteChildbirthController extends Controller
{
    private $childbirthService;

    public function __construct(ChildbirthService $service)
    {
        $this->childbirthService = $service;
    }

    public function index()
    {
        return view('deleted-models.deleted-childbirths', [
            'childbirths' => $this->childbirthService->getDeletedChildbirths(),
        ]);
    }

    public function restore(Request $request, $childbirth)
    {
        $this->childbirthService->restore($childbirth);
        return redirect('/deleted/childbirths')->with('message', 'Berhasil dikembalikan');
    }

    public function destroy($childbirth)
    {
        $this->childbirthService->forceDelete($childbirth);
        return redirect('/deleted/childbirths')->with('message', 'Berhasil dihapus permanen');
    }
}
