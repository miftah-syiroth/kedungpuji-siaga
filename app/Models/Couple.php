<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Couple extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'couples';
    protected $guarded = [];
    
    
    public function monthlyReport($year, $month)
    {
        return $this->keluargaBerencana()->where('year_periode', $year)->where('month_periode', $month)->first();
    }

    public function anualReport($year)
    {
        return $this->keluargaBerencana()->where('year_periode', $year)->get();
    }

    // START RELASI

    /**
     * namanya pasangan ya hanya ada 2 org, satu husband satu wife.
     * husband_id yg ada pada tabel couples hanya mencau pada satu org
     * @return void
     */
    public function husband()
    {
        return $this->belongsTo(Person::class, 'husband_id');
    }
    
    /**
     * namanya pasangan ya hanya ada 2 org, satu husband satu wife
     * wife_id yg ada pada tabel couples hanya mencau pada satu org
     * @return void
     */
    public function wife()
    {
        return $this->belongsTo(Person::class, 'wife_id');
    }
    
    /**
     * pasangan hanya memiliki satu service antara pemerintah atau swasta
     *
     * @return void
     */
    public function kbService()
    {
        return $this->belongsTo(KbService::class, 'kb_service_id');
    }

    public function keluargaBerencana()
    {
        return $this->hasMany(KeluargaBerencana::class, 'couple_id');
    }

    // ambil data KB terakhir
    public function latestKeluargaBerencana()
    {
        return $this->hasOne(KeluargaBerencana::class, 'couple_id')->latestOfMany();
    }
}
