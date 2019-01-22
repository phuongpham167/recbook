<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    private $object =   ['RealEstate','Banner'];
    protected $table    =   'activities';
    public function user(){
        if($this->user_id!=0)
            return $this->belongsTo(User::class);
        return false;
    }
    public function object(){
        return $this->belongsTo($this->type, 'object_id');
    }
}
