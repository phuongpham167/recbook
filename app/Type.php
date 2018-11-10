<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\WebScope;

class Type extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table    =   'type';
    public function customers()
    {
        return $this->hasMany('\App\Customer');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
