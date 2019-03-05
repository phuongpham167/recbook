<?php
/*
$$$$$$$$\ $$\   $$\  $$$$$$\  $$\   $$\       $$$$$$$\  $$$$$$\ $$\   $$\ $$\   $$\       $$\    $$\ $$\   $$\
\__$$  __|$$ |  $$ |$$  __$$\ $$$\  $$ |      $$  __$$\ \_$$  _|$$$\  $$ |$$ |  $$ |      $$ |   $$ |$$ |  $$ |
   $$ |   $$ |  $$ |$$ /  $$ |$$$$\ $$ |      $$ |  $$ |  $$ |  $$$$\ $$ |$$ |  $$ |      $$ |   $$ |$$ |  $$ |
   $$ |   $$ |  $$ |$$$$$$$$ |$$ $$\$$ |      $$ |  $$ |  $$ |  $$ $$\$$ |$$$$$$$$ |      \$$\  $$  |$$ |  $$ |
   $$ |   $$ |  $$ |$$  __$$ |$$ \$$$$ |      $$ |  $$ |  $$ |  $$ \$$$$ |$$  __$$ |       \$$\$$  / $$ |  $$ |
   $$ |   $$ |  $$ |$$ |  $$ |$$ |\$$$ |      $$ |  $$ |  $$ |  $$ |\$$$ |$$ |  $$ |        \$$$  /  $$ |  $$ |
   $$ |   \$$$$$$  |$$ |  $$ |$$ | \$$ |      $$$$$$$  |$$$$$$\ $$ | \$$ |$$ |  $$ |         \$  /   \$$$$$$  |
   \__|    \______/ \__|  \__|\__|  \__|      \_______/ \______|\__|  \__|\__|  \__|          \_/     \______/
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use App\Scopes\WebScope;

class Customer extends Model
{
    use Notifiable, SoftDeletes, HasApiTokens;
    protected $dates = ['deleted_at'];
    protected $table    =   'customer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function source()
    {
        return $this->belongsTo('\App\Source');
    }

    public function type()
    {
        return $this->belongsTo('\App\Type');
    }

    public function receipts(){
        return $this->hasMany(Receipt::class);
    }

    public function customergroups(){
        return $this->hasMany(CustomerGroup::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
}
