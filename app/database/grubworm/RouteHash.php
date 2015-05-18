<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $type_nbr
 * @property string $hash_text
 * @property string $actual_path_text
 * @property datetime $expire_date
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class RouteHash extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'route_hash_t';
}