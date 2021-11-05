<?php

namespace App\Http\Controllers\Deleted;

use App\Http\Controllers\Controller;
use App\Services\PuerperalService;
use Illuminate\Http\Request;

class DeletePuerperalController extends Controller
{
    private $puerperalService;

    public function __construct(PuerperalService $service)
    {
        $this->puerperalService = $service;
    }

    public function index()
    {
        return view('deleted-models.deleted-puerperals', [
            'puerperals' => $this->puerperalService->getDeletedPuerperals(),
        ]);
    }

    public function restore(Request $request, $puerperal)
    {
        $is_success = $this->puerperalService->restore($puerperal);
        if ($is_success == true) {
            return redirect('/deleted/puerperals')->with('message', 'Berhasil dikembalikan');
        } else {
            return redirect('/deleted/puerperals')->with('message', 'Kehamilan sudah memiliki data nifas lainnya!');
        }
        
    }

    public function destroy($puerperal)
    {
        $this->puerperalService->deletePermanently($puerperal);
        return redirect('/deleted/puerperals')->with('message', 'Berhasil dihapus permanen');
    }
}
