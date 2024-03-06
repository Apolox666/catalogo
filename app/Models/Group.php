<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Responsible;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
      
    ];

    public function responsibles()
    {
        return $this->belongsToMany(Responsible::class);
    }

}
