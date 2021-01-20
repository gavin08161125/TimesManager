<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    //
    protected $table = 'to_do_lists';
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    public function User() {
        return $this -> hasOne('App\User','id','user_id');
    }
}
