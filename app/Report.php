<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\WebScope;

class Report extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table    =   'report';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
