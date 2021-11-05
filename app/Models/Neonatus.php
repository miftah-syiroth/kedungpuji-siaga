<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Neonatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'neonatuses';
    protected $guarded = [];

    protected $casts = [
        'visited_at' => 'datetime:Y-m-d',
    ];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id');
    }
}
