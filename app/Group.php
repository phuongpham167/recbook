<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\WebScope;

class Group extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table    =   'groups';
    public function users()
    {
        return $this->hasMany('\App\User');
    }

//    protected static function boot()
//    {
//        parent::boot();
//
//        static::addGlobalScope(new WebScope);
//    }
}
