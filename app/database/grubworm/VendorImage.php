<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $vendor_id
 * @property string $os_text
 * @property string $license_text
 * @property string $image_id_text
 * @property string $image_name_text
 * @property text $image_description_text
 * @property integer $architecture_nbr
 * @property string $region_text
 * @property string $availability_zone_text
 * @property string $root_storage_text
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class VendorImage extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'vendor_image_t';
}