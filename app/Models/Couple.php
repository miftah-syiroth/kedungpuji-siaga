<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Couple extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'couples';
    protected $guarded = [];

    // SCOPE
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['is_kb'] ?? false, function($query, $is_kb) {
            return $query->where('is_kb', $is_kb);
        });

        $query->when($filters['rt'] ?? false, fn($query, $rt) => 
            $query->whereHas('wife', fn($query) => 
                $query->where('rt', $rt)
            )
        );

        $query->when($filters['rw'] ?? false, function(Builder $query, $rw) {
            return $query->whereHas('wife', function (Builder $query) use ($rw) {
                $query->where('rw', $rw);
            });
        });

        $query->when($filters['wife_name'] ?? false, function(Builder $query, $wife_name) {
            return $query->whereHas('wife', function (Builder $query) use ($wife_name) {
                $query->where('name', 'like', '%' .  $wife_name . '%');
            });
        });

        $query->when($filters['pus'] ?? false, fn($query) => 
            $query->whereHas('wife', fn($query) => 
                $query->whereDate('date_of_birth', '<=', Carbon::now()->addYears(-15) ) //koreksi lagi
                    ->whereDate('date_of_birth', '>=', Carbon::now()->addYears(-49) )
            )
        );

        $query->when($filters['non_pus'] ?? false, fn($query) => 
            $query->whereHas('wife', fn($query) => 
                $query->whereDate('date_of_birth', '>', Carbon::now()->addYears(-15) ) //koreksi lagi
                    ->orWhereDate('date_of_birth', '<', Carbon::now()->addYears(-49) )
            )
        );
    }

    public function scopeKeluargaBerencana($query, array $filters)
    {
        $query->when($filters['wife_name'] ?? false, function(Builder $query, $wife_name) {
            return $query->whereHas('wife', function (Builder $query) use ($wife_name) {
                $query->where('name', 'like', '%' .  $wife_name . '%');
            });
        });

        $query->when($filters['rt'] ?? false, fn($query, $rt) => 
            $query->whereHas('wife', fn($query) => 
                $query->where('rt', $rt)
            )
        );

        $query->when($filters['rw'] ?? false, function(Builder $query, $rw) {
            return $query->whereHas('wife', function (Builder $query) use ($rw) {
                $query->where('rw', $rw);
            });
        });

        $query->when($filters['is_kb'] ?? false, function($query, $is_kb) {
            return $query->where('is_kb', $is_kb);
        });

        $query->when($filters['kb_service_id'] ?? false, function($query, $kb_service_id) {
            return $query->where('kb_service_id', $kb_service_id);
        });

        $query->when($filters['year_periode'] ?? false, function(Builder $query, $year_periode) {
            return $query->whereHas('keluargaBerencana', function (Builder $query) use ($year_periode) {
                $query->where('year_periode', $year_periode);
            });
        }, function($query) {
            return $query->whereHas('keluargaBerencana', function (Builder $query) {
                $query->where('year_periode', Carbon::now()->year);
            });
        });
    }
    
    // protected $with = ['kbService', 'wife', 'husband'];
    
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
