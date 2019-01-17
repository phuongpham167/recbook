<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    public function category(){
        return $this->belongsTo(FLCategory::class, 'category_id');
    }
    public function deals(){
        return $this->hasMany(FLDeal::class, 'freelancer_id');
    }
}
