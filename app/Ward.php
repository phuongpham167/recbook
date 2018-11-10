<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\WebScope;

class Ward extends Model
{
    protected $table = 'ward';

    public function province()
    {
        return $this->belongsTo('\App\Province');
    }

    public function district()
    {
        return $this->belongsTo('\App\District');
    }
}
