<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class Responsible extends Model
{
    use HasFactory;

    public function grupos() {
        return $this->belongsToMany(Group::class);
    }
    
}
