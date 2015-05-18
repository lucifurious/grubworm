<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $owner_id
 * @property integer $owner_type_nbr
 * @property string $client_id
 * @property string $client_secret
 * @property string $server_secret
 * @property string $key_class_text
 * @property datetime $created_at
 * @property datetime $updated_at
*/
class AppKey extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'app_key_t';
}