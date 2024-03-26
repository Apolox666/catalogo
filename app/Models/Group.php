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
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($group) {
            $group->state = 1;
        });
    }
    public function responsibles()
    {
        return $this->belongsToMany(Responsible::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'group_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'groups_id', 'id');
    }
}
