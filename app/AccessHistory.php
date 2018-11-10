<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\WebScope;

class AccessHistory extends Model
{
    protected $table = 'accesshistories';

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
