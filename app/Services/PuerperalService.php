<?php
namespace App\Services;

use App\Models\Puerperal;

class PuerperalService
{    
    public function getDeletedPuerperals()
    {
        return Puerperal::onlyTrashed()
            ->with(['pregnancy' => function ($query) {
                $query->withTrashed();
            }, ])->get();
    }

    public function update($request, $puerperal)
    {
        $puerperal->update([
            'conclusion' => $request->conclusion,
        ]);

        $puerperal->motherConditions()->sync($request->mother_condition_id);
        $puerperal->complications()->sync($request->puerperal_complication_id);
        $puerperal->babyConditions()->sync($request->baby_condition_id);
    }

    public function destroy($puerperal)
    {
        // hapus neonatus
        if (isset($puerperal->puerperalClasses)) {
            $puerperal->puerperalClasses()->delete();
        }
        $puerperal->delete();
    }

    public function deletePermanently($puerperal)
    {
        $puerperal = Puerperal::withTrashed()->find($puerperal);

        // hapus table intermediate untuk kondisi ibu dan anak selama nifas
        $puerperal->babyConditions()->detach();
        $puerperal->motherConditions()->detach();
        $puerperal->complications()->detach();

        // hapus permanen dgn relasinya
        if (isset($puerperal->puerperalClasses)) {
            $puerperal->puerperalClasses()->forceDelete();
        }
        
        $puerperal->forceDelete();
    }

    public function restore($puerperal)
    {
        $puerperal = Puerperal::withTrashed()->find($puerperal);

        
        $pregnancy = $puerperal->pregnancy;
        //cek apakah parent kehamilan sudah ada relasi dgn nifas lainnya, relasinya one to one
        if (isset($pregnancy->puerperal)) { // jika sudah berelasi dgn nifas lainnya, batalkan
            return false;
        } else {
            if (isset($puerperal->puerperalClasses)) {
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
