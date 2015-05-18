<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $storage_id_text
 * @property boolean $private_ind
 * @property boolean $registration_ind
 * @property integer $user_id
 * @property string $user_storage_id_text
*/
class InstanceJanitor extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'instance_janitor_t';
}