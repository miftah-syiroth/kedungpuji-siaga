<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyStatus extends Model
{
    use HasFactory;

    protected $table = 'family_statuses';
    protected $guarded = [];

    public function people()
    {
        return $this->hasMany(PersonFamily::class, 'family_status_id');
    }
}
