<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couple extends Model
{
    use HasFactory;

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
     * namanya pasangan ya hanya ada 2 org, satu husband satu wife
     *
     * @return void
     */
    public function husband()
    {
        return $this->belongsTo(Person::class, 'suami_id');
    }
    
    /**
     * namanya pasangan ya hanya ada 2 org, satu husband satu wife
     *
     * @return void
     */
    public function wife()
    {
        return $this->belongsTo(Person::class, 'istri_id');
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
    
    /**
     * pregnancies, sebuah pasangan tentu saja bisa punya banyak kehamilan dan kelahiran
     *
     * @return void
     */
    // public function pregnancies()
    // {
    //     return $this->hasMany(PregnantWoman::class, 'couple_id');
    // }
}
