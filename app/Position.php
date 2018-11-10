<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\WebScope;

class Position extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table    =   'position';
    public function users()
    {
        return $this->hasMany('\App\User');
    }

    public function departments()
    {
        return $this->belongsTo('\App\Department','department_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
