<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
Use App\Project;

class ProjectUser extends Model
{
    protected $table = 'project_user';
    protected $fillable = ['project_id', 'user_id'];

}
