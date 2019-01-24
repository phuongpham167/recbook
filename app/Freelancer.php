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
    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function ward(){
        return $this->belongsTo(Ward::class);
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
