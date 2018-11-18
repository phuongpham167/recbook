<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PasswordReset extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table    =   'password_resets';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
