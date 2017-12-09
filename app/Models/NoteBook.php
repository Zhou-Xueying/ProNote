<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteBook extends Model
{
    use softDeletes;

    protected $table = 'notebook';
    protected $primaryKey = 'bookid';

    //cannot be updated
    protected $guarded = ['bookid','email'];

    //soft delete
    protected $dates = ['deleted_at'];

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
