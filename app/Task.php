<?php

namespace App;

use Illuminate\Support\Facades\DB;
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
    protected $fillable = ['project_id','user_id','name', 'startingtime', 'deadline', 'totaltime','task_point','picker', 'created_at', 'updated_at','add_point','status','feedback'];


    public function project() {
        return $this -> hasOne('App\Project','id','project_id');
    }


    public function users() {
        return $this -> hasMany('App\User','id','user_id');
    }



//批量更新 來源:https://stackoverflow.com/questions/26133977/laravel-bulk-update
    /*
 * ----------------------------------
 * update batch
 * ----------------------------------
 *
 * multiple update in one query
 *
 * tablename( required | string )
 * multipleData ( required | array of array )
 */
static function updateBatch($tableName = "", $multipleData = array()){

    if( $tableName && !empty($multipleData) ) {

        // column or fields to update
        $updateColumn = array_keys($multipleData[0]);
        $referenceColumn = $updateColumn[0]; //e.g id
        unset($updateColumn[0]);
        $whereIn = "";

        $q = "UPDATE ".$tableName." SET ";
        foreach ( $updateColumn as $uColumn ) {
            $q .=  $uColumn." = CASE ";

            foreach( $multipleData as $data ) {
                $q .= "WHEN ".$referenceColumn." = ".$data[$referenceColumn]." THEN '".$data[$uColumn]."' ";
            }
            $q .= "ELSE ".$uColumn." END, ";
        }
        foreach( $multipleData as $data ) {
            $whereIn .= "'".$data[$referenceColumn]."', ";
        }
        $q = rtrim($q, ", ")." WHERE ".$referenceColumn." IN (".  rtrim($whereIn, ', ').")";

        // Update
        return DB::update(DB::raw($q));

    } else {
        return false;
    }
}

}


