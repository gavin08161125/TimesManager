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
    ];

    public function users() {
        return $this -> belongsToMany(User :: class,'project_user');
    }


}

