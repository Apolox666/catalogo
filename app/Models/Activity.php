<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
      
    ];

  
    public function group()
    {
        return $this->belongsTo(Group::class, 'groups_id');
    }
    protected $attributes = [
        'priority' => 0,
        'time' =>0,
        'groups_id' =>0,
    ];
}
