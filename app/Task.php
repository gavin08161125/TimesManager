<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $pro_id
 * @property string $name
 * @property string $startingtime
 * @property string $deadline
 * @property int $totaltime
 * @property string $picker
 * @property string $created_at
 * @property string $updated_at
 */
class Task extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */

    protected $table = 'tasks';
    protected $fillable = ['pro_id', 'name', 'startingtime', 'deadline', 'totaltime', 'picker', 'created_at', 'updated_at'];

}
