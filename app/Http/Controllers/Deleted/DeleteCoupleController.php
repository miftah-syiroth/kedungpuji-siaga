<?php

namespace App\Http\Controllers\Deleted;

use App\Http\Controllers\Controller;
use App\Services\CoupleService;
use Illuminate\Http\Request;

class DeleteCoupleController extends Controller
{
    private $coupleService;

    public function __construct(CoupleService $service)
    {
        $this->coupleService = $service;
    }

    public function index()
    {
        return view('deleted-models.deleted-couples', [
            'couples' => $this->coupleService->getDeletedCouples(),
        ]);
    }

    public function restore(Request $request, $couple)
    {
        $is_success = $this->coupleService->restore($couple);

        if ($is_success == true) {
            return redirect('/deleted/couples')->with('message', 'Berhasil dikembalikan');
        } else {
            return redirect('/deleted/couples')->with('message', 'Istri sudah memiliki suami lainnya!');
        }
        
    }

    public function destroy($couple)
    {
        $this->coupleService->forceDelete($couple);
        return redirect('/deleted/couples')->with('message', 'Berhasil dihapus permanen');
    }
}
