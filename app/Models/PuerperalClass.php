<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PuerperalClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'puerperal_classes';
    protected $guarded = [];

    protected $casts = [
        'visited_at' => 'datetime:Y-m-d',
    ];

    public function puerperal()
    {
        return $this->belongsTo(Puerperal::class, 'puerperal_id');
    }
}
