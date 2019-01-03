<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table    =   'friends';

    public function fuser1()
    {
        return $this->belongsTo('\App\User', 'user1');
    }
    public function fuser2()
    {
        return $this->belongsTo('\App\User', 'user2');
    }
}
