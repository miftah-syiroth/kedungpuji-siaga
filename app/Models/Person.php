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
    
    /**
     * age method menghitung umur berdasarkan tanggal lahir
     *
     * @return void
     */
    // public function age()
    // {
    //     return Carbon::parse($this->attributes['date_of_birth'])->age;
    // }

    public function getDateOfBirthAttribute($value)
    {
        // return Carbon::parse($this->attributes['date_of_birth'])->isoFormat('DD MMMM Y');
        return Carbon::parse($this->attributes['date_of_birth']);
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

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function education()
    {
        return $this->belongsTo(Educational::class, 'educational_id');
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
     * disability merelasikan many to one ke pada status disabilitas
     *
     * @return void
     */
    public function disability()
    {
        return $this->belongsTo(Disability::class, 'disability_id');
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
    
    /**
     * family, sebuah keluarga memiliki banyak anggota, seseorang hanya bisa tercantum pada satu keluarga
     *
     * @return void
     */
    public function family()
    {
        return $this->belongsTo(Family::class, 'family_id');
    }
    
    /**
     * seseorang hanya bisa menjadi kepala keluarga sebuah keluarga, tidak double. demikian sebaliknya
     * one to one
     * @return void
     */
    public function kepalaKeluarga()
    {
        return $this->hasOne(Family::class, 'person_id');
    }

        
    /**
     * couples method untuk relasi one to many laki2 terhadap pasasngan. setiap laki2 dapat memiliki banyak istri
     *
     * @param  mixed $var
     * @return void
     */
    public function wifes()
    {
        return $this->hasMany(Couple::class, 'suami_id');
    }
    
    /**
     * couple method untuk relasi one to one, satu istri hanya punya satu suami
     *
     * @param  mixed $var
     * @return void
     */
    public function husband()
    {
        return $this->hasOne(Couple::class, 'istri_id');
    }
    
    /**
     * seseorang bisa menjadi ibu bagi banyak orang/anak
     * anak-anak dari ibu. 
     * @param  mixed $var
     * @return void
     */
    public function motherChildren()
    {
        return $this->hasMany(Person::class, 'ibu_id');
    }

    /**
     * seseorang hanya memiliki satu ibu kandung
     *
     * @param  mixed $var
     * @return void
     */
    public function mother()
    {
        return $this->belongsTo(Person::class, 'ibu_id');
    }
    
    /**
     * seseorang bisa menjadi ayah bagi banyak orang/anak
     *
     * @param  mixed $var
     * @return void
     */
    public function fatherChildren()
    {
        return $this->hasMany(Person::class, 'ayah_id');
    }
    
    /**
     * seseorang hanya bisa memiliki satu ayah kandung
     *
     * @return void
     */
    public function father()
    {
        return $this->belongsTo(Person::class, 'ayah_id');
    }
    
    /**
     * pregnancies, bahwa seorang wanita bisa mengalami banyak kehamilan. semua data tsb akan dicatat
     *
     * @param  mixed $var
     * @return void
     */
    public function pregnancies()
    {
        return $this->hasMany(Pregnancy::class, 'mother_id');
    }
    
    /**
     * prenatalClasses, has many through. Untuk mengakses laporan trimester kehamilan individu melalui data kehamilan yang ada
     *
     * @return void
     */
    public function prenatalClasses()
    {
        return $this->hasManyThrough(
            Pregnancy::class, 
            PrenatalClass::class,
            'mother_id', 
            'pregnancy_id',
            'id',
            'id',
        );
    }
    
    /**
     * keluargaBerencana has many through antara ibu/person ke laporan KB
     *
     * @return void
     */
    public function keluargaBerencana()
    {
        return $this->hasManyThrough(
            KeluargaBerencana::class,
            Couple::class,
            'istri_id',
            'couple_id',
            'id',
            'id',
        );
    }
}
