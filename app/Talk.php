<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    //
    protected $table = 'talks';
    protected $fillable = [
        'user_id',
        'content',
    ];
}
