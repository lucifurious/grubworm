<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property bigint $id
 * @property string $queue
 * @property text $payload
 * @property boolean $attempts
 * @property boolean $reserved
 * @property integer $reserved_at
 * @property integer $available_at
 * @property integer $created_at
*/
class Job extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'job_t';
}