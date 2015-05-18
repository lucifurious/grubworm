<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $instance_id
 * @property datetime $activate_by_date
 * @property integer $extend_count_nbr
 * @property integer $user_notified_nbr
 * @property integer $action_reason_nbr
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class DeactivationArch extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'deactivation_arch_t';
}