<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $vendor_name_text
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class Vendor extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'vendor_t';
}