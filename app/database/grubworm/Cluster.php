<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $owner_id
 * @property integer $owner_type_nbr
 * @property string $cluster_id_text
 * @property string $subdomain_text
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class Cluster extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'cluster_t';
}