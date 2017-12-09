<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model{

    protected $table = 'friendship';
    protected $primaryKey = 'shipid';

    public $timestamps = false;
}