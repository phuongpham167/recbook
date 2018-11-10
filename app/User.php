<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use App\Scopes\WebScope;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group()
    {
        return $this->belongsTo('\App\Group');
    }

    public function branch()
    {
        return $this->belongsTo('\App\Branch');
    }

    public function schedules()
    {
        return $this->hasMany('\App\Schedule');
    }

    public function jobdetails()
    {
        return $this->hasMany('\App\JobDetails');
    }
    public function receipts(){
        return $this->hasMany(Receipt::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
