<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReSource extends Model
{
    protected $table = 're_sources';

    protected $fillable = [
        'name', 'description'
    ];
}
