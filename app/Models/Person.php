<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';
    protected $guarded = [];

    protected $casts = [
        'date_of_birth' => 'datetime:Y-m-d',
    ];

    public function age()
    {
        return Carbon::parse($this->attributes['date_of_birth'])->age;
    }
    
    /**
     * sex merelasi many to one pada person ke jenis kelamin
     *
     * @return void
     */
    public function sex()
    {
        return $this->belongsTo(Sex::class, 'sex_id');
    }
    
    /**
     * bloodGroup relasi many to one antara golongan darah dengan org
     *
     * @return void
     */
    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_id');
    }

    /**
     * maritaStatus relasi many to one antara status perkawinan dengan org
     *
     * @return void
     */
    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }
    
    /**
     * disability merelasikan many to one ke pada status disabilitas
     *
     * @return void
     */
    public function disability()
    {
        return $this->belongsTo(Disability::class, 'disability_id');
    }
    
    /**
     * family, sebuah keluarga memiliki banyak anggota selain kepala keluarga
     *
     * @return void
     */
    public function family()
    {
        return $this->belongsTo(Family::class, 'family_id');
    }
    
    /**
     * familyStatus relasi status keanggotaan seseorang dalam sebuah keluarga
     *
     * @return void
     */
    public function familyStatus()
    {
        return $this->belongsTo(FamilyStatus::class, 'family_status_id');
    }

    public function kepalaKeluarga()
    {
        return $this->hasOne(Family::class, 'person_id');
    }
}
