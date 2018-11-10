<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RangePrice extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'description'
    ];

    public function reCategories()
    {
        return $this->belongsToMany('App\ReCategory', 'range_price_re_category');
    }
}
