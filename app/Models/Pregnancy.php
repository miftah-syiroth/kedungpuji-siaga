<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pregnancy extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pregnancies';
    protected $guarded = [];

    protected $casts = [
        'hpht' => 'datetime:Y-m-d',
        'childbirth_date' => 'datetime:Y-m-d',
    ];

    protected $with = ['person', 'prenatalClasses'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['mother_name'] ?? false, fn($query, $mother_name) => 
            $query->whereHas('person', fn($query) => 
                $query->where('name', 'like', '%' .  $mother_name . '%')
            )
        );

        $query->when($filters['rt'] ?? false, fn($query, $rt) => 
            $query->whereHas('person', fn($query) => 
                $query->where('rt', $rt)
            )
        );

        $query->when($filters['rw'] ?? false, fn($query, $rw) => 
            $query->whereHas('person', fn($query) => 
                $query->where('rw', $rw)
            )
        );

        $query->when($filters['month_hpht'] ?? false, function($query, $month_hpht) {
            return $query->whereMonth('hpht', $month_hpht);
        });

        $query->when($filters['year_hpht'] ?? false, function($query, $year_hpht) {
            return $query->whereYear('hpht', $year_hpht);
        });

        $query->when($filters['month_childbirth'] ?? false, function($query, $month_childbirth) {
            return $query->whereMonth('childbirth_date', $month_childbirth);
        });

        $query->when($filters['year_childbirth'] ?? false, function($query, $year_childbirth) {
            return $query->whereYear('childbirth_date', $year_childbirth);
        });

        $query->when($filters['mother_condition_id'] ?? false, function($query, $mother_condition_id) {
            return $query->where('mother_condition_id', $mother_condition_id);
        });

        $query->when($filters['parturition_id'] ?? false, function($query, $parturition_id) {
            return $query->where('parturition_id', $parturition_id);
        });
    }
    
    /**
     * mother, sebuah kehamilan tentu saja dimiliki oleh satu individu wanita. tidak mungkin separuh organ dikandung oleh wanita lain macam bongkar pasang
     *
     * @param  mixed $var
     * @return void
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function prenatalClasses()
    {
        return $this->hasMany(PrenatalClass::class, 'pregnancy_id');
    }

    // relasi many to many
    public function motherCondition()
    {
        return $this->belongsTo(MotherCondition::class, 'mother_condition_id');
    }

    // one to one dengan nifas
    public function puerperal()
    {
        return $this->hasOne(Puerperal::class, 'pregnancy_id');
    }
    
    /**
     * kehamilan punyas satu type partus antar abortus, prematurus, atau maturus
     *
     * @return void
     */
    public function parturition()
    {
        return $this->belongsTo(Parturition::class, 'parturition_id');
    }
    
    /**
     * childbirths, sebuah kehamilan bisa punya 2 kelahiran semisal bayi kembar
     *
     * @return void
     */
    public function childbirths()
    {
        return $this->hasMany(Childbirth::class, 'pregnancy_id');
    }
}
