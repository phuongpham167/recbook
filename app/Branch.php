<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\WebScope;
class Branch extends Model
{
    use SoftDeletes;

    public function users()
    {
        return $this->hasMany('\App\User');
    }

    public function notify()
    {
        return $this->belongsToMany(Notify::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
