<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\WebScope;

class Department extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table    =   'department';
    public function users()
    {
        return $this->hasMany('\App\User');
    }

    public function positions()
    {
        return $this->hasMany('\App\Position');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
