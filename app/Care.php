<?php

namespace App;

use App\Scopes\WebScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Care extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function require(){
        return $this->belongsTo(RealEstate::class, 'realestate_id');
    }
    public function response(){
        return $this->belongsTo(RealEstate::class, 'response_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
