<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notify extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function branch()
    {
        return $this->belongsToMany(Branch::class);
    }
}
