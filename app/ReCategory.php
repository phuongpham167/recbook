<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReCategory extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 're_categories';

    protected $fillable = [
        'name', 'description'
    ];

    public function reTypes()
    {
        return $this->belongsToMany('App\ReType', 're_category_re_type');
    }

    public function rangePrices()
    {
        return $this->belongsToMany('App\RangePrice', 'range_price_re_category');
    }

    public function realEstate()
    {
        return $this->hasOne('App\RealEstate');
    }
}
