<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $table = 'departments';
    protected $fillable = [
        'user_id',
        'department',
        'position',
    ];

    public function user() {
        return $this -> hasOne('App\User','id','user_id');
    }
}
