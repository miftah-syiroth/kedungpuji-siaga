<?php

namespace App\Http\Controllers\Deleted;

use App\Http\Controllers\Controller;
use App\Models\Posyandu;
use App\Services\PosyanduService;
use Illuminate\Http\Request;

class DeletePosyanduController extends Controller
{
    private $posyanduService;

    public function __construct(PosyanduService $service)
    {
        $this->posyanduService = $service;
    }

    public function index()
    {
        return view('deleted-models.deleted-posyandu', [
            'posyandu' => $this->posyanduService->getDeletedPosyandu(),
        ]);
    }

    public function restore(Request $request, $posyandu)
    {
        $is_success = $this->posyanduService->restore($posyandu);
        if ($is_success == true) {
            return redirect('/deleted/posyandu')->with('message', 'Berhasil dikembalikan');
        } else {
            return redirect('/deleted/posyandu')->with('message', 'Anak sudah memiliki data posyandu lainnya!');
        }
        
    }

    public function destroy($posyandu)
    {
        $this->posyanduService->deletePermanently($posyandu);
        return redirect('/deleted/posyandu')->with('message', 'Berhasil dihapus permanen');
    }
}
