<?php
namespace App\Services;

use App\Models\Couple;
use App\Models\KbService;
use App\Models\KbStatus;
use App\Models\MaritalStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class CoupleService
{        
    /**
     * getCouples digunakan pada controller couple method index untuk menampilkan semua couples
     * karena input is_pus tidak bisa dijadikan sebuah parameter pada scop. saya buat unutk 2 local scope berbeda
     * @param  mixed $filters
     * @return void
     */
    public function getCouples($filters)
    {
        // cek apakah ada input dari is_pus
        if (isset($filters['is_pus'])) {
            if ($filters['is_pus'] == true) {
                $filters['pus'] = true;
            } else {
                $filters['non_pus'] = true;
            }
        }
        // dd($filters);

        return Couple::with([
            'husband', 
            'wife' => function ($query) {
                $query->where('is_alive', true)
                    ->where('village_id', 1);
            },
            'kbService',
            'latestKeluargaBerencana',
        ])->filter($filters)
            ->latest()
            ->paginate(20);
    }

    public function getCouple($couple)
    {
        return Couple::with([
            'husband.maritalStatus',
            'wife.maritalStatus',
            'kbService',
            'keluargaBerencana' => function ($query) {
                $query->where('year_periode', Carbon::now()->year);
            },
            'keluargaBerencana.kbStatus',
        ])->find($couple->id);
        // dd($result->keluargaBerencana()->count());
    }

    public function store($request)
    {
        return Couple::create($request->toArray());
    }

    public function update($request, $couple)
    {
        // $attributes = $request->all();

        // if ($request->has('suami_id')) {
        //     $attributes['suami_id'] = $request->suami_id;
        // }

        // if ($request->has('istri_id')) {
        //     $attributes['istri_id'] = $request->istri_id;
        // }

        $couple->update($request->all());
    }

    public function getDeletedCouples()
    {
        return Couple::onlyTrashed()
            ->with(['husband' => function($query) {
                $query->withTrashed();
            }, 'wife' => function($query) {
                $query->withTrashed();
            }, 'keluargaBerencana' => function($query) {
                $query->withTrashed();
            }, 'latestKeluargaBerencana' => function($query) {
                $query->withTrashed();
            }])->orderBy('deleted_at', 'desc')->get();
    }
    
    /**
     * delete couple dengan softdelete
     *
     * @return void
     */
    public function softDelete($request, $couple)
    {
        // ubah status kawin istri menjadi cerai
        $istri = $couple->wife;
        $suami = $couple->husband;

        $istri->update(['marital_status_id' => $request->marital_status_id]);
        $suami->update(['marital_status_id' => $request->marital_status_id]);

        // dd(isset($couple->keluargaBerencana));
        # hapus dulu KB datanya
        if ($couple->keluargaBerencana->isNotEmpty()) {
            $couple->keluargaBerencana()->delete();
        }
        $couple->delete();
    }

    public function forceDelete($couple)
    {
        $couple = Couple::withTrashed()
            ->with(['keluargaBerencana' => function($query) {
                $query->withTrashed();
            }])->find($couple);

        // dd($couple->keluargaBerencana);
        # hapus dulu KB datanya
        if ($couple->keluargaBerencana->isNotEmpty()) {
            $couple->keluargaBerencana()->forceDelete();
        }

        $couple->forceDelete();
    }

    public function restore($couple)
    {
        $couple = Couple::withTrashed()
            ->with(['keluargaBerencana' => function($query) {
                $query->withTrashed();
            }])->find($couple);
        
        $husband = $couple->husband;
        $wife = $couple->wife;
        // cancel jika salah satu pasangan null krn artinya terhapus
        // cek apakah istri sudah punya suami lagi, krn satu istri hanya boleh satu suami
        if ($wife->husband !== null || $wife == null || $husband == null) {
            return false;
        } else {
            if ($couple->keluargaBerencana->isNotEmpty()) {
                $couple->keluargaBerencana()->restore();
            }
    
            $couple->restore();
            $couple->wife->update(['marital_status_id' => 2]);
            $couple->husband->update(['marital_status_id' => 2]);

            return true;
        }
    }
    
    /**
     * getKbStatuses status kb ini akan ditampilkan pada input laporan kb per pasangan berdasarkan dia peserta atau bukan. jika peserta maka tampilkan alat kontrasepsi yang digunakan, jika bukan maka tampilakan status kehamilan
     *
     * @param  mixed $couple
     * @return void
     */
    public function getKbStatuses($couple)
    {
        if ($couple->is_kb == true) {
            return KbStatus::whereIn('id', [1,2,3,4,5,6,7])->get();
        } elseif ($couple->is_kb == false) {
            return KbStatus::whereIn('id', [8,9,10,11])->get();
        }
    }

    public function getKbAnualReport($couple, $year)
    {
        return $couple->keluargaBerencana()->with('kbStatus')->where('year_periode', $year)->get();
    }

    public function getCeraiStatuses()
    {
        return MaritalStatus::whereIn('id', [4,5,6])->get();
    }
}
