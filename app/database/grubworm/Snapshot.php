<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property bigint $id
 * @property integer $instance_id
 * @property integer $user_id
 * @property string $snapshot_id_text
 * @property string $url_text
 * @property datetime $expire_date
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class Snapshot extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'snapshot_t';
}