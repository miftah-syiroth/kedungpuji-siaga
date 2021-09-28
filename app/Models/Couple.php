<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couple extends Model
{
    use HasFactory;

    protected $table = 'couples';
    protected $guarded = [];
    
    /**
     * namanya pasangan ya hanya ada 2 org, satu husband satu wife
     *
     * @return void
     */
    public function husband()
    {
        return $this->belongsTo(Person::class, 'suami_id');
    }
    
    /**
     * namanya pasangan ya hanya ada 2 org, satu husband satu wife
     *
     * @return void
     */
    public function wife()
    {
        return $this->belongsTo(Person::class, 'istri_id');
    }
    
    /**
     * pasangan hanya memiliki satu service antara pemerintah atau swasta
     *
     * @return void
     */
    public function kbService()
    {
        return $this->belongsTo(KbService::class, 'kb_service_id');
    }
}
