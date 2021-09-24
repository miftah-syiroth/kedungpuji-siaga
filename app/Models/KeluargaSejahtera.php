<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluargaSejahtera extends Model
{
    use HasFactory;

    protected $table = 'keluarga_sejahtera';
    protected $guarded = [];

    public function families()
    {
        return $this->hasMany(Family::class, 'keluarga_sejahtera_id');
    }
}
