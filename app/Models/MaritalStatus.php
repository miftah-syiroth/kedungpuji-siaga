<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $table = 'marital_statuses';
    protected $guarded = [];

    public function couples()
    {
        return $this->hasMany(Couple::class, 'marital_status_id');
    }
}
