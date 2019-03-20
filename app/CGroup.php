<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CGroup extends Model
{
    protected $table    =   'company_groups';
    protected $fillable =   [
        'name',
        'role',
        'description',
        'user_id'
    ];
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id')->withPivot('role');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
