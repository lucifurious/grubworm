<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $type_name_text
 * @property blob $schema_text
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class Serverype extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'server_type_t';
}