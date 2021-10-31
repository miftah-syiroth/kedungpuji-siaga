<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;

    protected $table = 'posyandu';
    protected $guarded = [];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function neonatuses()
    {
        return $this->hasMany(Neonatus::class, 'posyandu_id');
    }

    public function anthropometries()
    {
        return $this->hasMany(Anthropometry::class, 'posyandu_id');
    }
}