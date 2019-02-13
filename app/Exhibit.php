<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exhibit extends Model
{
    protected $table = 'exhibits';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'description'
    ];
}
