<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\WebScope;

class JobDetails extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table    =   'jobdetails';
    public function category()
    {
        return $this->belongsTo('\App\Category');
    }
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
    public function executor()
    {
        return $this->belongsTo('\App\User');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
