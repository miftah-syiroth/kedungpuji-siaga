<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;

    protected $table = 'months';
    protected $guarded = [];

    public function keluargaBerencana()
    {
        return $this->hasMany(KeluargaSejahtera::class, 'month_id');
    }
}
