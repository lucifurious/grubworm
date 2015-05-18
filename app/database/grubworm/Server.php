<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $server_type_id
 * @property string $server_id_text
 * @property string $host_text
 * @property integer $mount_id
 * @property text $config_text
 * @property datetime $lmod_date
*/
class Server extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'server_t';
}