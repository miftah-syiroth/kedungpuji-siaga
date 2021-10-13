<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * PersonFamily adalah custom model untuk table intermediate many to many antara person dan family
 * ini berguna supaya bisa berelasi dengan model FamilyStatus
 */
class PersonFamily extends Pivot
{
    public function familyStatus()
    {
        return $this->belongsTo(FamilyStatus::class, 'family_status_id');
    }
}
