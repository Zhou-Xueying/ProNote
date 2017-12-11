<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'userinfo';
    protected $primaryKey = 'userid';

    //cannot be updated
    protected $guarded = ['userid','email'];

    public $timestamps = false;

}
