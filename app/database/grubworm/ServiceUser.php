<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $owner_id
 * @property string $first_name_text
 * @property string $last_name_text
 * @property string $nickname_text
 * @property string $email_addr_text
 * @property string $password_text
 * @property integer $owner_type_nbr
 * @property datetime $last_login_date
 * @property string $last_login_ip_text
 * @property string $remember_token
 * @property boolean $active_ind
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class ServiceUser extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'service_user_t';
}