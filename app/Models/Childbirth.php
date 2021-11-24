<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Childbirth extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'childbirths';
    protected $guarded = [];
    
    /**
     * pregnancy, relasi many to one.. bisa jadi ada banyak kelahiran (bayi kembar) yg mengacu pada satu kehamilan
     *
     * @return void
     */
    public function pregnancy()
    {
        return $this->belongsTo(Pregnancy::class, 'pregnancy_id');
    }

    /**
     * satu kelahiran tentu saja hanya utk satu org, one to one
     *
     * @param  mixed $var
     * @return void
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
    
    /**
     * sex, jenis kelamin bayi. relasi terhadap tabel kelamin
     *
     * @return void
     */
    public function sex()
    {
        return $this->belongsTo(Sex::class, 'sex_id');
    }

    // relasi many to many
    public function babyConditions()
    {
        return $this->belongsToMany(BabyCondition::class, 'childbirth_has_baby_conditions', 'childbirth_id', 'baby_condition_id');
    }
}
