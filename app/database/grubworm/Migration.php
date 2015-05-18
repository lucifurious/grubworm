<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $migration
 * @property integer $batch
*/
class Migration extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'migration_t';
}