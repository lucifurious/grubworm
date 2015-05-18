<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $role_name_text
 * @property text $description_text
 * @property boolean $active_ind
 * @property string $home_view_text
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class Role extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'role_t';
}