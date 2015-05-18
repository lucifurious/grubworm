<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $user_id
 * @property integer $role_id
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class UserRoleAsgn extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'user_role_asgn_t';
}