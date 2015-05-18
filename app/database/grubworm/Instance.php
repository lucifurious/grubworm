<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $app_server_id
 * @property integer $cluster_id
 * @property integer $db_server_id
 * @property integer $environment_id
 * @property integer $user_id
 * @property integer $web_server_id
 * @property integer $guest_location_nbr
 * @property string $instance_id_text
 * @property string $instance_name_text
 * @property text $instance_data_text
 * @property string $storage_id_text
 * @property string $db_host_text
 * @property integer $db_port_nbr
 * @property string $db_name_text
 * @property string $db_user_text
 * @property string $db_password_text
 * @property string $request_id_text
 * @property datetime $request_date
 * @property boolean $activate_ind
 * @property boolean $trial_instance_ind
 * @property boolean $provision_ind
 * @property boolean $deprovision_ind
 * @property integer $state_nbr
 * @property integer $ready_state_nbr
 * @property integer $platform_state_nbr
 * @property integer $storage_version_nbr
 * @property datetime $last_state_date
 * @property datetime $start_date
 * @property datetime $end_date
 * @property datetime $terminate_date
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class Instance extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'instance_t';
}