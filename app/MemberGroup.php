<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberGroup extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table    =   'member_group';
    public function usergroup()
    {
        return $this->belongsTo(UserGroup::class,'user_group_id');
    }
}
