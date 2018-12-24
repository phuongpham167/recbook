<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MappingMenuFE extends Model
{
    const SG_HOT = 1, SG_VIP = 2;
    protected $table    =   'mapping_menu_fe';
}
