<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalClass extends Model
{
    use HasFactory;

    protected $table = 'prenatal_classes';
    protected $guarded = [];

    public function pregnancy()
    {
        return $this->belongsTo(Pregnancy::class, 'pregnancy_id');
    }
}