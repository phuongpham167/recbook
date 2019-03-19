<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use App\Scopes\WebScope;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group()
    {
        return $this->belongsTo('\App\Group');
    }

    public function branch()
    {
        return $this->belongsTo('\App\Branch');
    }

    public function schedules()
    {
        return $this->hasMany('\App\Schedule');
    }

    public function jobdetails()
    {
        return $this->hasMany('\App\JobDetails');
    }
    public function receipts(){
        return $this->hasMany(Receipt::class);
    }

    public function userinfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function conversations()
    {
        return \App\Conversation::where('user1',$this->id)->orWhere('user2',$this->id)->get();
    }
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WebScope);
    }
    public function avatar(){
        return $this->userinfo?$this->userinfo->avatar():asset('/images/default-avatar.png');
    }
    public function owner(){
        return $this->hasMany(Freelancer::class);
    }
    public function owner_rate(){
        return lam_tron($this->owner()->average('rate'));
    }
    public function dealer(){
        return $this->hasMany(FLDeal::class);
    }
    public function dealer_rate(){
        return lam_tron($this->dealer()->average('rate'));
    }
    public function subcribes(){
        return $this->belongsToMany(Province::class, 'province_subcribes');
    }

    public function usergroups() {
        return $this->belongsToMany(UserGroup::class,'member_group');
    }

    public function companygroup()
    {
        return $this->belongsToMany(CGroup::class, 'group_user','user_id','group_id')->withPivot('group_id');
    }

    public function company()
    {
        return $this->belongsToMany(Company::class, 'company_user','user_id','company_id')->withPivot('company_id');
    }

    public function rolegroup()
    {
        return $this->belongsToMany(CGroup::class, 'group_user','user_id','group_id')->withPivot('role');
    }

    public function sharedcustomer() {
        return $this->belongsToMany(User::class,'shared_customer');
    }

    public function listFriend()
    {
        $data   =   Friend::where(function($q){
            $q->where('user1', $this->id);
        })->orWhere(function($q){
            $q->where('user2', $this->id);
        });
        return $data;
    }
    public function is_friend($id)
    {
        $data   =   Friend::where(function($q) use ($id){
            $q->where('user1', $this->id)
                ->where('user2', $id);
        })->orWhere(function($q) use ($id){
            $q->where('user2', $this->id)
                ->where('user1', $id);
        })->count();
        return $data?TRUE:FALSE;
    }
}
