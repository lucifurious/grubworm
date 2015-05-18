<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $owner_id
 * @property integer $owner_type_nbr
 * @property string $hash_text
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class OwnerHash extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'owner_hash_t';
}