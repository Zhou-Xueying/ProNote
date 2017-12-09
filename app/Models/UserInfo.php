<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'userinfo';
    protected $primaryKey = 'email';

    //cannot be updated
    protected $guarded = ['email'];

    public $timestamps = false;

}
