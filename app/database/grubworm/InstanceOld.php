<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $vendor_id
 * @property integer $vendor_image_id
 * @property integer $vendor_credentials_id
 * @property integer $guest_location_nbr
 * @property string $instance_id_text
 * @property text $instance_data_text
 * @property integer $app_server_id
 * @property integer $web_server_id
 * @property integer $db_server_id
 * @property string $db_host_text
 * @property integer $db_port_nbr
 * @property string $db_name_text
 * @property string $db_user_text
 * @property string $db_password_text
 * @property integer $cluster_id
 * @property string $storage_id_text
 * @property integer $storage_version_nbr
 * @property integer $flavor_nbr
 * @property string $base_image_text
 * @property string $instance_name_text
 * @property string $region_text
 * @property string $availability_zone_text
 * @property string $security_group_text
 * @property string $ssh_key_text
 * @property integer $root_device_type_nbr
 * @property string $public_host_text
 * @property string $public_ip_text
 * @property string $private_host_text
 * @property string $private_ip_text
 * @property string $request_id_text
 * @property datetime $request_date
 * @property boolean $deprovision_ind
 * @property boolean $provision_ind
 * @property boolean $trial_instance_ind
 * @property integer $state_nbr
 * @property integer $vendor_state_nbr
 * @property string $vendor_state_text
 * @property integer $ready_state_nbr
 * @property integer $platform_state_nbr
 * @property integer $environment_id
 * @property boolean $activate_ind
 * @property datetime $last_state_date
 * @property datetime $start_date
 * @property datetime $end_date
 * @property datetime $terminate_date
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class InstanceOld extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'instance_old_t';
}