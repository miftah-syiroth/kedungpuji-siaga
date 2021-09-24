<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    use HasFactory;

    protected $table = 'sexes';
    protected $guarded = [];

        
    /**
     * person membuat relasi one to many jenis kelamin dengan tabel person
     *
     * @return void
     */
    public function people()
    {
        return $this->hasMany(Person::class, 'sex_id');
    }
}
