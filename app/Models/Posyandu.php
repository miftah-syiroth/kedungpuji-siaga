<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posyandu extends Model
{
    use HasFactory, SoftDeletes;

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
    
    /**
     * anthropometries, fungsi untuk relasi one to many dengan kunjungan anthropometri
     *
     * @return void
     */
    public function anthropometries()
    {
        return $this->hasMany(Anthropometry::class, 'posyandu_id');
    }
    
    /**
     * latestAnthropometry, ambil data kunjungan posyandu paling akhir
     *
     * @return void
     */
    public function latestAnthropometry()
    {
        return $this->hasOne(Anthropometry::class, 'posyandu_id')->latestOfMany();
    }
}
