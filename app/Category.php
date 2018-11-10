<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\WebScope;

class Category extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table    =   'category';
    public function jobdetails()
    {
        return $this->hasMany('\App\JobDetails');
    }
    public function department()
    {
        return $this->hasOne('\App\Department');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
