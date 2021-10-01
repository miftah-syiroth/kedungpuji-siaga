<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluargaBerencana extends Model
{
    use HasFactory;

    protected $table = 'keluarga_berencana';
    protected $guarded = [];

    // START SCOPE
    // ambil data kb pada tahun dan bulan tertentu
    public function scopePopular($query, $year, $month)
    {
        return $query->where('year_periode', $year)
            ->where('month_periode', $month);
    }

    public function contraception()
    {
        return $this->belongsTo(Contraception::class, 'contraception_id');
    }

    public function pregnancy()
    {
        return $this->belongsTo(DesirePregnancy::class, 'desire_pregnancy_id');
    }

    public function couple()
    {
        return $this->belongsTo(Couple::class, 'couple_id');
    }

    // public function kbable()
    // {
    //     return $this->morphTo();
    // }
}
