<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $table = 'marital_statuses';
    protected $guarded = [];

    public function people()
    {
        return $this->hasMany(Person::class, 'marital_status_id');
    }
}
