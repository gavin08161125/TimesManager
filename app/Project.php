<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = [
        'title',
        'startingtime',
        'deadline',
        'totaltime',
        'description',
        'owner',
        'status',
    ];

    public function users() {
        return $this -> belongsToMany(User :: class,'project_user');
    }

    public function tasks() {
        return $this -> hasMany('App\Task');
    }

}

