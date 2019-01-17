<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FLCategory extends Model
{
    protected $table    =   'freelancer_categories';
    use SoftDeletes;
    public function freelancer(){
        return $this->hasMany(Freelancer::class, 'category_id');
    }
}
