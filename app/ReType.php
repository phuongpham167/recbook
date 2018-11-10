<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReType extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 're_types';

    protected $fillable = [
        'name', 'description'
    ];

    public function reCategories()
    {
        return $this->belongsToMany('App\ReCategory', 're_category_re_type');
    }
}
