<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $table = 'customer_group';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customers(){
        return $this->hasMany(Customer::class);
    }
}
