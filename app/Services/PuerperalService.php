<?php
namespace App\Services;


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
}
