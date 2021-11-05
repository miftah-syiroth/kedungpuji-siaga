<?php

namespace App\Models;

use FamilyScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'families';
    protected $guarded = [];

    // protected static function booted()
    // {
    //     static::addGlobalScope(new FamilyScope);
    // }

    // SCOPE
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['keluarga_sejahtera_id'] ?? false, function($query, $keluarga_sejahtera_id) {
            return $query->where('keluarga_sejahtera_id', $keluarga_sejahtera_id);
        });

        $query->when($filters['rt'] ?? false, function(Builder $query, $rt) {
            return $query->whereHas('leader', function (Builder $query) use ($rt) {
                $query->where('rt', $rt);
            });
        });

        $query->when($filters['rw'] ?? false, function(Builder $query, $rw) {
            return $query->whereHas('leader', function (Builder $query) use ($rw) {
                $query->where('rw', $rw);
            });
        });

        $query->when($filters['name'] ?? false, function(Builder $query, $name) {
            return $query->whereHas('leader', function (Builder $query) use ($name) {
                $query->where('name', 'like', '%' .  $name . '%');
            });
        });

        $query->when($filters['nomor_kk'] ?? false, function($query, $nomor_kk) {
            return $query->where('nomor_kk', $nomor_kk);
        });
    }
    
    /**
     * kepalaKeluarga relasi one to one bahwa sebuah keluarga hanya memiliki satu kepala keluarga
     *  dan sebaliknya
     * @return void
     */
    public function leader()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
    
    /**
     * people relasi one to many tp dengan tabel intermediate
     * @return void
     */
    public function people()
    {
        return $this->belongsToMany(Person::class, 'person_has_family', 'family_id', 'person_id')
            ->withPivot('family_status_id')
            ->using(PersonFamily::class);
    }

    public function keluargaSejahtera()
    {
        return $this->belongsTo(KeluargaSejahtera::class, 'keluarga_sejahtera_id');
    }
}
