<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $environment_name_text
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class Environment extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'environment_t';
}