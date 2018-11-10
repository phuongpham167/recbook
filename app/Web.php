<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Web extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function sources()
    {
        return $this->hasMany(Source::class);
    }
}
