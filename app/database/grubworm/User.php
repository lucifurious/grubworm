<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $email_addr_text
 * @property string $password_text
 * @property string $remember_token
 * @property string $first_name_text
 * @property string $last_name_text
 * @property string $nickname_text
 * @property string $api_token_text
 * @property string $storage_id_text
 * @property string $external_id_text
 * @property string $external_password_text
 * @property integer $owner_id
 * @property integer $owner_type_nbr
 * @property string $company_name_text
 * @property string $title_text
 * @property string $city_text
 * @property string $state_province_text
 * @property string $country_text
 * @property string $postal_code_text
 * @property string $phone_text
 * @property boolean $opt_in_ind
 * @property boolean $agree_ind
 * @property datetime $last_login_date
 * @property string $last_login_ip_text
 * @property boolean $admin_ind
 * @property boolean $activate_ind
 * @property boolean $active_ind
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class User extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'user_t';
}