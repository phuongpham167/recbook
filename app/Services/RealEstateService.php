<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/18/2018
 * Time: 1:00 AM
 */

namespace App\Services;
use App\Customer;
use App\RealEstate;
use App\Street;
use App\WebsiteConfig;
use Illuminate\Support\Facades\DB;
use Image;

class RealEstateService
{
    protected $needApprove;
    protected $web_id;
    public function __construct()
    {
        $this->needApprove = checkNeedApprove();
        $this->web_id = get_web_id();
    }

    public function getList()
    {
//        $list = RealEstate::with('reCategory', 'reType', 'province')->get();
        $list = RealEstate::get();
        return $list;
    }

    public function store($input)
    {
        $root = \Request::root();
        $slug = to_slug($input['title']);

        $phone = isset($input['contact_phone_number']) ? $input['contact_phone_number'] : '';
        $contactPerson = isset($input['contact_person']) ? $input['contact_person'] : '';
        $contactAddress = isset($input['contact_address']) ? $input['contact_address'] : '';

        $customer = null;
        if ($phone) {
            $customer = $this->checkCustomer($phone, $contactPerson, $contactAddress);
        }

        $imagesVal = [];
        if (isset($input['images'])) {
            $images = $input['images'];
            $alt = $input['alt'];
            foreach ($images as $key => $image) {
                $png_url = rand() . '_' . time().".png";
                $path = public_path().'/storage/uploads/' . $png_url;
                $thumbPath = public_path().'/storage/thumbs/' . $png_url;
                $watermark_logo = public_path().'/images/watermark_logo.png';

                $originImg = Image::make(file_get_contents($image))->insert($watermark_logo, 'bottom', 10, 10)->save($path);
                $thumbnail = $originImg->resize(122, 91)->save($thumbPath);
                $imagesVal[] = [
                    'link' => $root . '/storage/uploads/' . $png_url,
                    'alt' => $alt[$key]
                ];
            }
        }


        $lat = '';
        $long = '';
        if($m = $input['map']) {
            $maps = explode(',', $m);
            $lat = $maps[0];
            $long = $maps[1] ? $maps[1] : '';
        }

        $approve = isset($input['add_draft']) ? 0 : ($this->needApprove ? 0 : 1);

        if ($input['is_private'] == RealEstate::USER_PAGE || $input['is_private'] == RealEstate::USER_WEB) {
            $approve = 1;
        }

        $streetId = isset($input['street_id']) ? $input['street_id'] : '';
        $provinceId = isset($input['province_id']) ? $input['province_id'] : '';
        $districtId = isset($input['district_id']) ? $input['district_id'] : '';
        $wardId = isset($input['ward_id']) ? $input['ward_id'] : '';
        if ($provinceId && $districtId && $wardId && $streetId) {
            if(empty(Street::find($input['street_id'])))
            {
                $street = new Street();

                $street->name = $input['street_id'];
                $street->province_id = $input['province_id'];
                $street->district_id = $input['district_id'];
                $street->ward_id = $input['ward_id'];
                $street->save();
                $input['street_id'] = $street->id;
            }
        }

        $realEstate = new RealEstate([
            'title' => $input['title'],
            'slug' => $slug,
            'contact_person' => $contactPerson,
            'contact_phone_number' => $phone,
            'contact_address' => $contactAddress,
            're_category_id' => isset($input['re_category_id']) ? $input['re_category_id'] : null,
            're_type_id' => isset($input['re_type_id']) ? $input['re_type_id'] : null,
            'province_id' => isset($input['province_id']) ? $input['province_id'] : null,
            'district_id' => isset($input['district_id']) ? $input['district_id'] : null,
            'ward_id' => isset($input['ward_id']) ? $input['ward_id'] : null,
            'street_id' => isset($input['street_id']) ? $input['street_id'] : null,
            'address' => isset($input['address']) ? $input['address'] : null,
            'position' => isset($input['position']) ? $input['position'] : null,
            'direction_id' => isset($input['direction_id']) ? $input['direction_id'] : null,
            'exhibit_id' => isset($input['exhibit_id']) ? $input['exhibit_id'] : null,
            'project_id' => isset($input['project_id']) ? $input['project_id'] : null,
            'block_id' => isset($input['block_id']) ? $input['block_id'] : null,
            'construction_type_id' => isset($input['construction_type_id']) ? $input['construction_type_id'] : null,
            'width' => isset($input['width']) ? $input['width'] : null,
            'length' => isset($input['length']) ? $input['length'] : null,
            'bedroom' => isset($input['bedroom']) ? $input['bedroom']  : null,
            'living_room' => isset($input['living_room']) ? $input['living_room'] : null,
            'wc' => isset($input['wc'])  ?$input['wc'] : null,
            'area_of_premises' => isset($input['area_of_premises']) ? $input['area_of_premises'] : null,
            'area_of_use' => isset($input['area_of_use']) ? $input['area_of_use'] : null,
            'floor' => isset($input['floor']) ? $input['floor'] : null,
            'price' => isset($input['price']) ? $input['price'] : null,
            'unit_id' => isset($input['unit_id']) ? $input['unit_id'] : null,
            'range_price_id' => isset($input['range_price_id']) ? $input['range_price_id'] : null,
            'is_deal' => isset($input['is_deal']) ? 1 : 0,
            'post_date' => isset($input['post_date']) ? $input['post_date'] : null,
            'expire_date' => isset($input['expire_date']) ? $input['expire_date'] : null,
            'images' => json_encode($imagesVal),
            'lat' => $lat,
            'long' => $long,
            'detail' => isset($input['detail']) ? $input['detail'] : null,
            'is_private' => $input['is_private'],
            'customer_id' => $customer ? $customer->id : null,
            'posted_by' => \Auth::user()->id,
            'updated_by' => \Auth::user()->id,
            'web_id' => $this->web_id,
            'approve' => $approve,
            'draft' => isset($input['add_draft']) ? 1 : 0,
        ]);

        if($realEstate->save()) {
            $realEstate->code = config('real-estate.codePrefix') . '-' . $realEstate->id;
            $realEstate->save();
            return $realEstate;
        } else {
            return false;
        }
    }

    public function update($input)
    {
        $slug = to_slug($input['title']);

//        $phone = $input['contact_phone_number'];
//        $contactPerson = $input['contact_person'];
//        $contactAddress = $input['contact_address'];
//
//        $customer = $this->checkCustomer($phone, $contactPerson, $contactAddress);

        $imagesVal = [];
        if (isset($input['images'])) {
            $images = $input['images'];
            $alt = $input['alt'];
            foreach ($images as $key => $image) {
                $imagesVal[] = [
                    'link' => $image,
                    'alt' => $alt[$key]
                ];
            }
        }

        $lat = '';
        $long = '';
        if($m = $input['map']) {
            $maps = explode(',', $m);
            $lat = $maps[0];
            $long = $maps[1] ? $maps[1] : '';
        }

        if(empty(Street::find($input['street_id'])))
        {
            $street = new Street();

            $street->name = $input['street_id'];
            $street->province_id = $input['province_id'];
            $street->district_id = $input['district_id'];
            $street->ward_id = $input['ward_id'];
            $street->save();
            $input['street_id'] = $street->id;
        }
        
        $realEstate = RealEstate::find($input['id']);
        if ($realEstate) {
            $approve = $realEstate->draft ? 0 : ( $this->needApprove ? 0 : 1 );
            if ($input['is_private'] == RealEstate::USER_PAGE || $input['is_private'] == RealEstate::USER_WEB) {
                $approve = 1;
            }

            if (!$realEstate->code) {
                $realEstate->code = config('real-estate.codePrefix') . '-' . $realEstate->id;
            }
            $realEstate->title = $input['title'];
            $realEstate->slug = $slug;
            $realEstate->short_description = $input['short_description'];
            $realEstate->contact_person = $input['contact_person'];
            $realEstate->contact_phone_number = $input['contact_phone_number'];
            $realEstate->contact_address = $input['contact_address'];
            $realEstate->re_category_id = $input['re_category_id'];
            $realEstate->re_type_id = $input['re_type_id'];
            $realEstate->province_id = $input['province_id'];
            $realEstate->district_id = $input['district_id'];
            $realEstate->ward_id = $input['ward_id'];
            $realEstate->address = $input['address'];
            $realEstate->position = isset($input['position']) ? $input['position'] : '';
            $realEstate->street_id = $input['street_id'];
            $realEstate->direction_id = $input['direction_id'];
            $realEstate->exhibit_id = $input['exhibit_id'];
            $realEstate->project_id = $input['project_id'];
            $realEstate->block_id = $input['block_id'];
            $realEstate->construction_type_id = $input['construction_type_id'];
            $realEstate->width = $input['width'];
            $realEstate->length = $input['length'];
            $realEstate->bedroom = $input['bedroom'];
            $realEstate->living_room = $input['living_room'];
            $realEstate->wc = $input['wc'];
            $realEstate->area_of_premises = $input['area_of_premises'];
            $realEstate->area_of_use = $input['area_of_use'];
            $realEstate->floor = $input['floor'];
            $realEstate->price = $input['price'];
            $realEstate->unit_id = $input['unit_id'];
            $realEstate->range_price_id = $input['range_price_id'];
            $realEstate->is_deal = isset($input['is_deal']) ? 1 : 0;
            $realEstate->post_date = $input['post_date'];
            $realEstate->expire_date = $input['expire_date'];
            $realEstate->images = json_encode($imagesVal);
            $realEstate->lat = $lat;
            $realEstate->long = $long;
            $realEstate->detail = $input['detail'];
            $realEstate->is_private = $input['is_private'];
            $realEstate->updated_by = \Auth::user()->id;
            $realEstate->web_id = $this->web_id;
            $realEstate->approved = $approve;
//            if (isset($input['add_draft'])) {
//                $realEstate->approved = 0;
//                $realEstate->draft = 1;
//            } else {
//                $realEstate->approved = $this->needApprove ? 0 : 1;
//                $realEstate->draft = 0;
//            }

            if($realEstate->save()) {
                return $realEstate;
            } else {
                return false;
            }
        }
        return false;

    }

    public function updateAjax($input)
    {

        $phone = isset($input['contact_phone_number']) ? $input['contact_phone_number'] : '';
        $contactPerson = isset($input['contact_person']) ? $input['contact_person'] : '';
        $contactAddress = isset($input['contact_address']) ? $input['contact_address'] : '';

        $customer = null;
        if ($phone) {
            $customer = $this->checkCustomer($phone, $contactPerson, $contactAddress);
        }

        $root = \Request::root();
        $slug = to_slug($input['title']);

        $imagesVal = [];
        if (isset($input['imagesOld'])) {
            $imagesOld = $input['imagesOld'];
            $altOld = $input['altOld'];
            foreach ($imagesOld as $key => $img) {
                $imagesVal[] = [
                    'link' => $img,
                    'alt' => $altOld[$key]
                ];
            }
        }
        if (isset($input['imagesNew'])) {
            $imagesNew = $input['imagesNew'];
            $altNew = $input['altNew'];
            foreach ($imagesNew as $key => $image) {
                $png_url = rand() . '_' . time().".png";
                $path = public_path().'/storage/uploads/' . $png_url;
                $thumbPath = public_path().'/storage/thumbs/' . $png_url;
                $watermark_logo = public_path().'/images/watermark_logo.png';

                $originImg = Image::make(file_get_contents($image))->insert($watermark_logo, 'bottom', 10, 10)->save($path);
                $thumbnail = $originImg->resize(122, 91)->save($thumbPath);
                $imagesVal[] = [
                    'link' => $root . '/storage/uploads/' . $png_url,
                    'alt' => $altNew[$key]
                ];
            }
        }

        $lat = '';
        $long = '';
        if($m = $input['map']) {
            $maps = explode(',', $m);
            $lat = $maps[0];
            $long = $maps[1] ? $maps[1] : '';
        }

        $streetId = isset($input['street_id']) ? $input['street_id'] : '';
        $provinceId = isset($input['province_id']) ? $input['province_id'] : '';
        $districtId = isset($input['district_id']) ? $input['district_id'] : '';
        $wardId = isset($input['ward_id']) ? $input['ward_id'] : '';
        if ($provinceId && $districtId && $wardId && $streetId) {
            if (empty(Street::find($input['street_id']))) {
                $street = new Street();

                $street->name = $input['street_id'];
                $street->province_id = $input['province_id'];
                $street->district_id = $input['district_id'];
                $street->ward_id = $input['ward_id'];
                $street->save();
                $input['street_id'] = $street->id;
            }
        }

        $realEstate = RealEstate::find($input['id']);
        if ($realEstate) {
            $approve = $realEstate->draft ? 0 : ( $this->needApprove ? 0 : 1 );
            if ($input['is_private'] == RealEstate::USER_PAGE || $input['is_private'] == RealEstate::USER_WEB) {
                $approve = 1;
            }

            if (!$realEstate->code) {
                $realEstate->code = config('real-estate.codePrefix') . '-' . $realEstate->id;
            }
            $realEstate->title = $input['title'];
            $realEstate->slug = $slug;
            $realEstate->contact_person = $contactPerson;
            $realEstate->contact_phone_number = $phone;
            $realEstate->contact_address = $contactAddress;
            $realEstate->re_category_id = isset($input['re_category_id']) ? $input['re_category_id'] : null;
            $realEstate->re_type_id = isset($input['re_type_id']) ? $input['re_type_id'] : null;
            $realEstate->province_id = isset($input['province_id']) ? $input['province_id'] : null;
            $realEstate->district_id = isset($input['district_id']) ? $input['district_id'] : null;
            $realEstate->ward_id = isset($input['ward_id']) ? $input['ward_id'] : null;
            $realEstate->street_id = isset($input['street_id']) ? $input['street_id'] : null;
            $realEstate->address = isset($input['address']) ? $input['address'] : null;
            $realEstate->position = isset($input['position']) ? $input['position'] : '';
            $realEstate->direction_id = isset($input['direction_id']) ? $input['direction_id'] : null;
            $realEstate->exhibit_id = isset($input['exhibit_id']) ? $input['exhibit_id'] : null;
            $realEstate->project_id = isset($input['project_id']) ? $input['project_id'] : null;
            $realEstate->block_id = isset($input['block_id']) ? $input['block_id'] : null;
            $realEstate->construction_type_id = isset($input['construction_type_id']) ? $input['construction_type_id'] : null;
            $realEstate->width = isset($input['width']) ? $input['width'] : null;
            $realEstate->length = isset($input['length']) ? $input['length'] : null;
            $realEstate->bedroom = isset($input['bedroom']) ? $input['bedroom']  : null;
            $realEstate->living_room = isset($input['living_room']) ? $input['living_room'] : null;
            $realEstate->wc = isset($input['wc'])  ?$input['wc'] : null;
            $realEstate->area_of_premises = isset($input['area_of_premises']) ? $input['area_of_premises'] : null;
            $realEstate->area_of_use = isset($input['area_of_use']) ? $input['area_of_use'] : null;
            $realEstate->floor = isset($input['floor']) ? $input['floor'] : null;
            $realEstate->price = isset($input['price']) ? $input['price'] : null;
            $realEstate->unit_id = isset($input['unit_id']) ? $input['unit_id'] : null;
            $realEstate->range_price_id = isset($input['range_price_id']) ? $input['range_price_id'] : null;
            $realEstate->is_deal = isset($input['is_deal']) ? ( $input['is_deal'] ? 1 : 0 ) : 0;
            $realEstate->post_date = isset($input['post_date']) ? $input['post_date'] : null;
            $realEstate->expire_date = isset($input['expire_date']) ? $input['expire_date'] : null;
            $realEstate->images = json_encode($imagesVal);
            $realEstate->lat = $lat;
            $realEstate->long = $long;
            $realEstate->detail = isset($input['detail']) ? $input['detail'] : null;
            $realEstate->is_private = $input['is_private'];
            $realEstate->customer_id = $customer ? $customer->id : null;
            $realEstate->updated_by = \Auth::user()->id;
            $realEstate->web_id = $this->web_id;
            $realEstate->approved = $approve;
//            if (isset($input['add_draft'])) {
//                $realEstate->approved = 0;
//                $realEstate->draft = 1;
//            } else {
//                $realEstate->approved = $this->needApprove ? 0 : 1;
//                $realEstate->draft = 0;
//            }

            if($realEstate->save()) {
                return RealEstate::with(['district', 'reCategory'])->find($input['id']);
            } else {
                return false;
            }
        }
        return false;

    }

    public function multiDelete($ids)
    {
        try {
            RealEstate::whereIn('id', $ids)->get()
                ->map( function ($realEstate) {
                   $realEstate->delete();
                });
            return true;
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return false;
        }
    }

    public function publish($data)
    {
        $approve = $this->needApprove ? 0 : 1;
        if ($data->is_private == RealEstate::USER_PAGE || $data->is_private == RealEstate::USER_WEB) {
            $approve = 1;
        }
        $data->draft = 0;
        $data->approved = $approve;
        $data->save();
    }

    public function customerByPhone($phone)
    {
        $data = Customer::where('phone', $phone)->select('id', 'name', 'address')->first();
        return $data;
    }

    private function checkCustomer($phone, $contactPerson, $contactAddress)
    {
        $customer = Customer::where('phone', $phone)->first();
        if (!$customer) {
            $customer = new Customer([
                'name' => $contactPerson ? $contactPerson : 'Khách lẻ',
                'phone' => $phone,
                'address' => $contactAddress
            ]);
            $customer->save();
        }
        return $customer;
    }
}
