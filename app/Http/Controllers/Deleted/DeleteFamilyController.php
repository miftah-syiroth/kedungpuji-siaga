<?php

namespace App\Http\Controllers\Deleted;

use App\Http\Controllers\Controller;
use App\Services\FamilyService;
use Illuminate\Http\Request;

class DeleteFamilyController extends Controller
{
    private $familyService;

    public function __construct(FamilyService $service)
    {
        $this->familyService = $service;
    }

    public function index()
    {
        return view('deleted-models.deleted-families', [
            'families' => $this->familyService->getDeletedFamilies(),
        ]);
    }

    public function restore(Request $request, $family)
    {
        $is_success = $this->familyService->restore($family);

        if ($is_success == true) {
            return redirect('/deleted/families')->with('message', 'Berhasil dikembalikan');
        } else {
            return redirect('/deleted/families')->with('message', 'Kepala Keluarga memiliki keluarga lainnya');
        }
    }

    public function destroy($family)
    {
        $this->familyService->forceDelete($family);
        return redirect('/deleted/families')->with('message', 'Berhasil dihapus permanen');
    }
}
