<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregnancy extends Model
{
    use HasFactory;

    protected $table = 'pregnancies';
    protected $guarded = [];

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
}
