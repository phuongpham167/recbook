<?php

namespace App;

use App\Scopes\OrderByDateDescScope;
use App\Scopes\PrivateScope;
use App\Scopes\ProvinceScope;
use App\Scopes\PublicScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RealEstate extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    const same_search = 'SSO', related_item = 'RI';
    const USER_PAGE = 1, USER_WEB = 2, COMPANY_WEB = 3, REG_WEB = 4;

    protected $table = 'real_estates';

    protected $fillable = [
        'title',
        'short_description',
        'contact_person',
        'contact_phone_number',
        'contact_address',
        're_category_id',
        're_type_id',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'position',
        'street_id',
        'direction_id',
        'exhibit_id',
        'project_id',
        'block_id',
        'construction_type_id',
        'width',
        'length',
        'bedroom',
        'living_room',
        'wc',
        'area_of_premises',
        'area_of_use',
        'floor',
        'price',
        'unit_id',
        'range_price_id',
        'is_deal',
        'post_date',
        'expire_date',
        'images',
        'lat',
        'long',
        'detail',
        'source',
        'is_private',
        'posted_by',
        'updated_by',
        'approved',
        'draft',
        'code',
        'views',
        'is_vip',
        'vip_expire_at',
        'is_hot',
        'hot_expire_at',
        'link_video',
        'customer_id',
        'slug',
        'web_id',
        'is_public',
        'loai_bds',
        'don_vi',
        'public_site'
    ];

    public function direction()
    {
        return $this->belongsTo('App\Direction');
    }

    public function reCategory()
    {
        return $this->belongsTo('App\ReCategory');
    }

    public function reType()
    {
        return $this->belongsTo('App\ReType');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function province()
    {
        return $this->belongsTo('App\Province');
    }
    public function district()
    {
        return $this->belongsTo('App\District');
    }
    public function street()
    {
        return $this->belongsTo('App\Street');
    }
    public function exhibit()
    {
        return $this->belongsTo('App\Exhibit');
    }
    public function block()
    {
        return $this->belongsTo('App\Block');
    }
    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
    public function user()
    {
        return $this->belongsTo('\App\User', 'posted_by');
    }
    public function reports(){
        return $this->hasMany(ReReport::class, 'real_estate_id');
    }
    public function customer()
    {
        return $this->belongsTo('\App\Customer');
    }
    public function scopeFilterprovince($query)
    {
        if(!empty(session('tinhthanhquantam')))
            return $query->whereIn('province_id', explode(",",session('tinhthanhquantam')));
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PrivateScope());
        static::addGlobalScope(new OrderByDateDescScope());
    }
}
