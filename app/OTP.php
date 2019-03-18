<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class OTP extends Model
{
    use SyncsWithFirebase;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'otp_service';

    protected $fillable = [
        'content', 'phoneNumber', 'send',
    ];

}
