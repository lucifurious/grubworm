<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $cluster_id
 * @property integer $server_id
 * @property datetime $create_date
 * @property datetime $lmod_date
*/
class ClusterServerAsgn extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'cluster_server_asgn_t';
}