<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\WebScope;

class Province extends Model
{
    protected $table = 'province';

//    protected static function boot()
//    {
//        parent::boot();
//
//        static::addGlobalScope(new WebScope);
//    }
}
