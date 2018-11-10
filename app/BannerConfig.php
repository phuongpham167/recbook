<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerConfig extends Model
{
    protected $table = 'banner_config';

    protected $fillable = ['header', 'slide', 'banner_left', 'banner_right',
        'banner_in_post', 'banner_in_body'];
}
