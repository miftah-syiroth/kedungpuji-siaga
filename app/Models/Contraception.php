<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contraception extends Model
{
    use HasFactory;

    protected $table = 'contraceptions';
    protected $guarded = [];
    
    /**
     * keluargaBerencana relasi one to mony polymorphic
     *
     * @return void
     */
    // public function keluargaBerencana()
    // {
    //     return $this->morphMany(KeluargaBerencana::class, 'kbable');
    // }
    
    /**
     * couples method relasi many to many polymorphic dengan pregnancy
     *
     * @return void
     */
    public function couples()
    {
        return $this->morphToMany(Couple::class, 'coupleable')->withPivot('year_periode', 'month_periode');
    }

    // relasi many to many polymorphic dengan spesifikasi
    public function coupleRow($year, $month)
    {
        return $this->morphedByMany(Couple::class, 'coupleable')
            ->wherePivot('year_periode', $year)
            ->wherePivot('month_periode', $month)
            ->first();
    }
}
