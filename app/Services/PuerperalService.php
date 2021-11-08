<?php
namespace App\Services;

use App\Models\Puerperal;

class PuerperalService
{    
    public function update($request, $puerperal)
    {
        $puerperal->update([
            'conclusion' => $request->conclusion,
        ]);

        $puerperal->motherConditions()->sync($request->mother_condition_id);
        $puerperal->complications()->sync($request->puerperal_complication_id);
        $puerperal->babyConditions()->sync($request->baby_condition_id);
    }

    public function getDeletedPuerperals()
    {
        return Puerperal::onlyTrashed()
            ->with(['pregnancy' => function ($query) {
                $query->withTrashed();
            }, ])->orderBy('deleted_at', 'desc')->get();
    }
    
    /**
     * destroy with softDelete
     *
     * @param  mixed $puerperal
     * @return void
     */
    public function softDelete($puerperal)
    {
        if ($puerperal->puerperalClasses->isNotEmpty()) {
            $puerperal->puerperalClasses()->delete();
        }
        $puerperal->delete();
    }

    public function forceDelete($puerperal)
    {
        $puerperal = Puerperal::withTrashed()
            ->with(['puerperalClasses' => function($query) {
                $query->withTrashed();
            }])->find($puerperal);

        // hapus permanen dgn relasinya
        if ($puerperal->puerperalClasses->isNotEmpty()) {
            $puerperal->puerperalClasses()->forceDelete();
        }

        // hapus table intermediate untuk kondisi ibu dan anak selama nifas
        $puerperal->babyConditions()->detach();
        $puerperal->motherConditions()->detach();
        $puerperal->complications()->detach();

        $puerperal->forceDelete();
    }

    public function restore($puerperal)
    {
        $puerperal = Puerperal::withTrashed()
            ->with(['puerperalClasses' => function($query) {
                $query->withTrashed();
            }])->find($puerperal);

        $pregnancy = $puerperal->pregnancy;
        // batalkan jika pregnancy null/dihapus atau sudah ada data puerperal lain (relasi one to one ga boleh ada 2 puerperal)
        if ($pregnancy == null || $pregnancy->puerperal !== null) {
            return false;
        } else {
            if ($puerperal->puerperalClasses->isNotEmpty()) {
                $puerperal->puerperalClasses()->restore();
            }
            $puerperal->restore();
            return true;
        }
    }

    public function getPeriode()
    {
        return (
            [
                ['nomor' => 1, 'min' => '0', 'max' => '6 jam'], // 0-6 jam
                ['nomor' => 2, 'min' => '6', 'max' => '48 jam'], //6-48 jam
                ['nomor' => 3, 'min' => '3', 'max' => '7 hari'], //3-7 hari
                ['nomor' => 4, 'min' => '8', 'max' => '48 hari'], //8-28 hari
            ]
        );
    }
}
