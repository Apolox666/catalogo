<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function subprocess()
    {
        return $this->belongsTo(Subprocess::class, 'subprocesses_id');
    }

    // Relación con Group
    public function group()
    {
        return $this->belongsTo(Group::class, 'groups_id');
    }
}
