<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RealEstate extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

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
        'street_id',
        'direction_id',
        'exhibit_id',
        'project_id',
        'block_id',
        'construction_type_id',
        'width',
        'length',
        'bedroom',
        'area_of_premises',
        'area_of_use',
        'floor',
        'price' ,
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
        'updated_by'
    ];

    public function reCategory()
    {
        return $this->belongsTo('App\ReCategory');
    }

    public function reType()
    {
        return $this->belongsTo('App\ReType');
    }

    public function province()
    {
        return $this->belongsTo('App\Province');
    }
    public function district()
    {
        return $this->belongsTo('App\District');
    }
    public function user()
    {
        return $this->belongsTo('\App\User', 'posted_by');
    }
}
