<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_info';

    protected $fillable = [
        'user_id', 'company', 'identification', 'phone', 'address', 'website'
    ];
    public function avatar(){
        if(!empty($this->avatar)){
            return $this->avatar;
        }else{
            return asset('/images/default-avatar.png');
        }
    }
}
