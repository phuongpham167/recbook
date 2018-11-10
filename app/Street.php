<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\WebScope;

class Street extends Model
{
    protected $table = 'street';

    public function province()
    {
        return $this->belongsTo('\App\Province');
    }

    public function district()
    {
        return $this->belongsTo('\App\District');
    }
    public function ward()
    {
        return $this->belongsTo('\App\Ward');
    }
}
