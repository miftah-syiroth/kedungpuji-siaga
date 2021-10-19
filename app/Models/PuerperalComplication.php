<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuerperalComplication extends Model
{
    use HasFactory;

    protected $table = 'puerperal_complications';
    protected $guarded = [];

    // many to many komplikasi ibu
    public function puerperals()
    {
        return $this->belongsToMany(Puerperal::class, 'puerperal_has_complications', 'puerperal_complication_id', 'puerperal_id');
    }
}
