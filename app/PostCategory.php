<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'postcategory';

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
