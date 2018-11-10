<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\WebScope;

class Receipt extends Model
{
    public function account(){
        return $this->belongsTo(Account::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function target_user(){
        if($this->target_type=='user')
            return $this->belongsTo(User::class, 'target_user_id');
        elseif($this->target_type == 'customer')
            return $this->belongsTo(Customer::class, 'target_user_id');
    }
    public function receipt_type(){
        return $this->belongsTo(ReceiptType::class,'receipt_types_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
