<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KbService extends Model
{
    use HasFactory;

    protected $table = 'kb_services';
    protected $guarded = [];
}
