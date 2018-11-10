<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\WebScope;

class HistoryStatus extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table    =   'historystatus';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
