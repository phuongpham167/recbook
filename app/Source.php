<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\WebScope;

class Source extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table    =   'source';
    public function customers()
    {
        return $this->hasMany('\App\Customer');
    }

    public function website()
    {
        return $this->belongsTo(Web::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
