<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table    =   'companies';

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'company_user')->withPivot('confirmed');
    }

    public function group()
    {
        return $this->hasMany(CGroup::class);
    }
}
