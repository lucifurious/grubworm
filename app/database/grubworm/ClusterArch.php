<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $cluster_id_text
 * @property string $subdomain_text
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class ClusterArch extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'cluster_arch_t';
}