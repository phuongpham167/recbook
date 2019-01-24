<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FLDeal extends Model
{
    protected $table    =   'freelancer_deals';
    public function dealer(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function freelancer(){
        return $this->belongsTo(Freelancer::class, 'freelancer_id');
    }
}
