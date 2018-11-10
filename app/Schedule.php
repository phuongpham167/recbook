<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\WebScope;

class Schedule extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table    =   'schedule';
    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
