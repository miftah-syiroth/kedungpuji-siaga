<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couple extends Model
{
    use HasFactory;

    protected $table = 'couples';
    protected $guarded = [];

    public function husband()
    {
        return $this->belongsTo(Person::class, 'suami_id');
    }

    public function wife()
    {
        return $this->belongsTo(Person::class, 'istri_id');
    }
}
