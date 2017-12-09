<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use softDeletes;

    protected $table = 'note';
    protected $primaryKey = 'noteid';

    //cannot be updated
    protected $guarded = ['noteid','bookid','userid'];

    //soft delete
    protected $dates = ['delete_at'];

    //time stamp
    public $timestamps = true;
    protected function getDateFormat(){
        return time();
    }
    public function fromDateTime($value) {
        return $value;
    }
    protected function asDateTime($value){
        return $value;
    }
}
