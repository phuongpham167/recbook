<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteConfig extends Model
{
    protected $table = 'website_config';

    protected $fillable = ['logo', 'chat_code', 'google', 'google_app_id',
        'facebook', 'facebook_app_id', 'title', 'keyword', 'description'];
}
