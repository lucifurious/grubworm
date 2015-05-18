<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $instance_id
 * @property integer $server_id
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class InstanceServerAsgnArch extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'instance_server_asgn_arch_t';
}