<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KbStatus extends Model
{
    use HasFactory;

    protected $table = 'kb_statuses';
    protected $guarded = [];

    public function keluargaBerencana()
    {
        return $this->hasMany(KeluargaBerencana::class, 'kb_status_id');
    }
}
