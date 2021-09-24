<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contraception extends Model
{
    use HasFactory;

    protected $table = 'contraceptions';
    protected $guarded = [];
}
