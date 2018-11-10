<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\WebScope;

class District extends Model
{
    protected $table = 'district';

    public function province()
    {
        return $this->belongsTo('\App\Province');
    }
}
