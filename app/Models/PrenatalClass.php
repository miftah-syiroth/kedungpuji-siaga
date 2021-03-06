<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrenatalClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'prenatal_classes';
    protected $guarded = [];

    protected $casts = [
        'visited_at' => 'datetime:Y-m-d',
    ];

    public function pregnancy()
    {
        return $this->belongsTo(Pregnancy::class, 'pregnancy_id');
    }
}
