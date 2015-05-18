<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $instance_id
 * @property integer $vendor_id
 * @property integer $vendor_image_id
 * @property integer $vendor_credentials_id
 * @property integer $flavor_nbr
 * @property string $base_image_text
 * @property string $region_text
 * @property string $availability_zone_text
 * @property string $security_group_text
 * @property string $ssh_key_text
 * @property integer $root_device_type_nbr
 * @property string $public_host_text
 * @property string $public_ip_text
 * @property string $private_host_text
 * @property string $private_ip_text
 * @property integer $state_nbr
 * @property string $state_text
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class InstanceGuestArch extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'instance_guest_arch_t';
}