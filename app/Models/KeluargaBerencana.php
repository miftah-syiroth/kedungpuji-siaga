<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeluargaBerencana extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'keluarga_berencana';
    protected $guarded = [];

    public function scopeMonthly($query, $year, $month)
    {
        return $query->where('year_periode', $year)->where('month_periode', $month)->first();
    }

    public function scopeAnual($query, $year)
    {
        return $query->where('year_periode', $year)->get();
    }

    public function couple()
    {
        return $this->belongsTo(Couple::class, 'couple_id');
    }

    public function kbStatus()
    {
        return $this->belongsTo(KbStatus::class, 'kb_status_id');
    }
}
