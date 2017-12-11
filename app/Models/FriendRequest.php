<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model{

    protected $table = 'friendRequest';
    protected $primaryKey = 'requestid';

    public $timestamps = false;
}