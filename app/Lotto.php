<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lotto extends Model
{
    //
    protected $table = 'lottos';
    protected $fillable = [
        'user_id',
        'prize',
        'awarded',
    ];

}
