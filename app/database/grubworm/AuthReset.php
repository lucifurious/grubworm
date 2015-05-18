<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $token
 * @property datetime $created_at
*/
class AuthReset extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected $table = 'auth_reset_t';
}