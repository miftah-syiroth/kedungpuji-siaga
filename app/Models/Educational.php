<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educational extends Model
{
    use HasFactory;

    protected $table = 'educationals';
    protected $guarded = [];

    public function people()
    {
        return $this->hasMany(Person::class, 'educational_id');
    }
}
