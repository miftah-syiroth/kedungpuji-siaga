<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parturition extends Model
{

    use HasFactory;

    protected $table = 'parturitions';
    protected $guarded = [];

    public function pregnancies()
    {
        return $this->hasMany(Pregnancy::class, 'parturition_id');
    }
}
