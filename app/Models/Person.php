<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'people';
    protected $guarded = [];

    protected $casts = [
        'date_of_birth' => 'datetime:Y-m-d',
        'died_at' => 'datetime:Y-m-d',
    ];


    // SCOPE
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['sex_id'] ?? false, function($query, $sex_id) {
            return $query->where('sex_id', $sex_id);
        });

        $query->when($filters['rt'] ?? false, function($query, $rt) {
            return $query->where('rt', $rt);
        });

        $query->when($filters['rw'] ?? false, function($query, $rw) {
            return $query->where('rw', $rw);
        });

        $query->when($filters['name'] ?? false, function($query, $name) {
            return $query->where('name', 'like', '%' .  $name . '%');
        });

        $query->when($filters['mother_name'] ?? false, fn($query, $mother_name) => 
            $query->whereHas('mother', fn($query) => 
                $query->where('name', 'like', '%' .  $mother_name . '%')
            )
        );

        $query->when($filters['year_of_birth'] ?? false, function($query, $year_of_birth) {
            return $query->whereYear('date_of_birth', $year_of_birth);
        });

        $query->when($filters['marital_status_id'] ?? false, function($query, $marital_status_id) {
            return $query->where('marital_status_id', $marital_status_id);
        });

        $query->when($filters['posyandu'] ?? false, function($query) {
            return $query->has('posyandu');
        });

        $query->when($filters['non_posyandu'] ?? false, function($query) {
            return $query->doesntHave('posyandu');
        });
    }
    
    
    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_id');
    }

    public function disability()
    {
        return $this->belongsTo(Disability::class, 'disability_id');
    }

    public function educational()
    {
        return $this->belongsTo(Educational::class, 'educational_id');
    }

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function sex()
    {
        return $this->belongsTo(Sex::class, 'sex_id');
    }

    /**
     * relasi ibu dan anak, bahwa seorang ibu bisa memiliki banyak anak/orang
     *
     * @param  mixed $var
     * @return void
     */
    public function motherChildren()
    {
        return $this->hasMany(Person::class, 'mother_id');
    }
    
    /**
     * relasi ibu dan anak, seseorang hanya memiliki satu ibu kandung
     *
     * @return void
     */
    public function mother()
    {
        return $this->belongsTo(Person::class, 'mother_id');
    }
        
    /**
     * relasi ayah dan anak, seorang ayah bisa memiliki banyak anak kandung
     *
     * @return void
     */
    public function fatherChildren()
    {
        return $this->hasMany(Person::class, 'father_id');
    }

    /**
     * relasi ayah dan anak, seseorang hanya memiliki satu ayah kandung
     *
     * @return void
     */
    public function father()
    {
        return $this->belongsTo(Person::class, 'father_id');
    }

    /**
     * relasi one to one antara kepala keluarga dengan keluarga. seorang hanya punya satu keluarga yang dipimpin
     *
     * @return void
     */
    public function ledFamily()
    {
        return $this->hasOne(Family::class, 'person_id');
    }

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
     * couples method untuk relasi one to many laki2 terhadap pasasngan. setiap laki2 dapat memiliki banyak istri
     * husband_id pada table couple mengacu pada person yang menjadi suami dari pasangan tersebut.
     * @param  mixed $var
     * @return void
     */
    public function wifes() // couples
    {
        return $this->hasMany(Couple::class, 'husband_id');
    }
    
    /**
     * couple method untuk relasi one to one, satu istri hanya punya satu suami
     * wife_id pada table couple mengacu pada person yang menjadi istri dari pasangan tersebut
     * @param  mixed $var
     * @return void
     */
    public function husband() // couple
    {
        return $this->hasOne(Couple::class, 'wife_id');
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

    
    /**
     * puerperal, has one through antara person (ibu) one to one pergnancy one to one puerperal
     *
     * @return void
     */
    // public function puerperal()
    // {
    //     return $this->hasOneThrough(
    //         Puerperal::class, 
    //         Pregnancy::class,
    //         'mother_id',
    //         'pregnancy_id',
    //         'id',
    //         'id',
    //     );
    // }
}
