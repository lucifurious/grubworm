<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $vendor_id
 * @property integer $environment_id
 * @property text $keys_text
 * @property string $label_text
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class VendorCredentials extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'vendor_credentials_t';
}