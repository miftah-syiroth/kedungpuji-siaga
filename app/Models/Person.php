<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';
    protected $guarded = [];

    protected $casts = [
        'date_of_birth' => 'datetime:Y-m-d',
        'died_at' => 'datetime:Y-m-d',
    ];
    
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
     * maritaStatus relasi many to one antara status perkawinan dengan org
     *
     * @return void
     */
    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }

    /**
     * familyStatus relasi status keanggotaan seseorang dalam sebuah keluarga
     * !! ini ga perlu krn harusnya ada ditable intermediate
     *
     * @return void
     */
    // public function familyStatus()
    // {
    //     return $this->belongsTo(FamilyStatus::class, 'family_status_id');
    // }
    
    /**
     * satu org hanya tercatat pada satu keluarga. relasinya harusnya many to one, tp akan rusak jika terjadi 
     * kematian atau perubahan pada kepala keluarga, perlu kebutuhan utk edit kepala keluarga. sehingga dibuat
     * tabel intermediate many to many laravel biar bisa pakai fitur-fitur yg ada
     *
     * @return void
     */
    public function family()
    {
        return $this->belongsToMany(Family::class, 'person_has_family', 'person_id', 'family_id')
            ->withPivot('family_status_id')
            ->using(PersonFamily::class);
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
     * setiap orang pasti menjadi satu objek yg dilahirkan dari sebuah kehamilan
     *
     * @return void
     */
    public function childbirth()
    {
        return $this->hasOne(Pregnancy::class, 'baby_id');
    }

    // Get the mother's most recent pregnancy.
    public function latestPregnancy()
    {
        return $this->hasOne(Pregnancy::class, 'mother_id')->latestOfMany();
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
    
    /**
     * pelayanan posyandu selama 5 tahun
     *
     * @return void
     */
    public function posyandu()
    {
        return $this->hasOne(Posyandu::class, 'person_id');
    }
}
