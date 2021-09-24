<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $table = 'families';
    protected $guarded = [];
    
    /**
     * kepalaKeluarga relasi one to one bahwa sebuah keluarga hanya memiliki satu kepala keluarga
     *  dan sebaliknya
     * @return void
     */
    public function leadBy()
    {
        // return $this->hasOne(Person::class, 'person_id');
        return $this->belongsTo(Person::class, 'person_id');
    }
    
    /**
     * people relasi one to many, sebuah keluarga memiliki banyak person as member
     *
     * @return void
     */
    public function people()
    {
        return $this->hasMany(Person::class, 'family_id');
    }

    public function keluargaSejahtera()
    {
        return $this->belongsTo(KeluargaSejahtera::class, 'keluarga_sejahtera_id');
    }
}
