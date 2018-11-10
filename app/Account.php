<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\WebScope;

class Account extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function receipts(){
        return $this->hasMany(Receipt::class);
    }
    public function currency(){
        return $this->belongsTo(Currency::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
