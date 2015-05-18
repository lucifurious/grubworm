<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $mount_type_nbr
 * @property string $mount_id_text
 * @property integer $owner_id
 * @property integer $owner_type_nbr
 * @property string $root_path_text
 * @property text $config_text
 * @property datetime $last_mount_date
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class Mount extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'mount_t';
}