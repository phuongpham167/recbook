<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleCustomer extends Model
{
    protected $table = 'schedule_customer';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
