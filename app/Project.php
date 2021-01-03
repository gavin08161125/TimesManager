<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'startingtime',
        'deadline',
        'totaltime',
        'description',
        'owner',
    ];

    public function users() {
        return $this -> belongsToMany('User');
    }


}

