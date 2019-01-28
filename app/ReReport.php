<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReReport extends Model
{
    protected $table = 're_reports';

    public function realestate(){
        return $this->belongsTo(RealEstate::class, 'real_estate_id');
    }
}
