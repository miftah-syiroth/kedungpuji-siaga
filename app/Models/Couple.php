<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couple extends Model
{
    use HasFactory;

    protected $table = 'couples';
    protected $guarded = [];
    
    
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

    // public function keluargaBerencana()
    // {
    //     return $this->hasMany(KeluargaBerencana::class, 'couple_id');
    // }


    // relasi many to many polymorphic
    public function contraceptions()
    {
        return $this->morphedByMany(Contraception::class, 'coupleable')->withPivot('year_periode', 'month_periode');
    }

    // relasi many to many polymorphic
    public function pregnancies()
    {
        return $this->morphedByMany(Pregnancy::class, 'coupleable')->withPivot('year_periode', 'month_periode');
    }

    // relasi many to many polymorphic dengan spesifikasi
    public function contraceptionRow($year, $month)
    {
        return $this->morphedByMany(Contraception::class, 'coupleable')
            ->wherePivot('year_periode', $year)->wherePivot('month_periode', $month)->first();
    }

    public function pregnancyRow()
    {
        return $this->morphedByMany(Pregnancy::class, 'coupleable')->withPivot('year_periode', 'month_periode');
    }    

}
