<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    use HasFactory;

    protected $table = 'blood_groups';
    protected $guarded = [];
    
    /**
     * people menampilkan relasi one to many dengan person
     *
     * @return void
     */
    public function people()
    {
        return $this->hasMany(Person::class, 'blood_group_id');
    }
}
