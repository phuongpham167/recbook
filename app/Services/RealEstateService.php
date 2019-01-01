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
use App\WebsiteConfig;
use Illuminate\Support\Facades\DB;

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
        $slug = to_slug($input['title']);

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

        $approve = isset($input['add_draft']) ? 0 : ($this->needApprove ? 0 : 1);

        $realEstate = new RealEstate([
            'title' => $input['title'],
            'slug' => $slug,
            'short_description' => $input['short_description'],
            'contact_person' => $input['contact_person'],
            'contact_phone_number' => $input['contact_phone_number'],
            'contact_address' => $input['contact_address'],
            're_category_id' => $input['re_category_id'],
            're_type_id' => $input['re_type_id'],
            'province_id' => $input['province_id'],
            'district_id' => $input['district_id'],
            'ward_id' => $input['ward_id'],
            'address' => $input['address'],
            'position' => $input['position'],
            'street_id' => $input['street_id'],
            'direction_id' => $input['direction_id'],
            'exhibit_id' => $input['exhibit_id'],
            'project_id' => $input['project_id'],
            'block_id' => $input['block_id'],
            'construction_type_id' => $input['construction_type_id'],
            'width' => $input['width'],
            'length' => $input['length'],
            'bedroom' => $input['bedroom'],
            'living_room' => $input['living_room'],
            'wc' => $input['wc'],
            'area_of_premises' => $input['area_of_premises'],
            'area_of_use' => $input['area_of_use'],
            'floor' => $input['floor'],
            'price' => $input['price'],
            'unit_id' => $input['unit_id'],
            'range_price_id' => $input['range_price_id'],
            'is_deal' => isset($input['is_deal']) ? 1 : 0,
            'post_date' => $input['post_date'],
            'expire_date' => $input['expire_date'],
            'images' => json_encode($imagesVal),
            'lat' => $lat,
            'long' => $long,
            'detail' => $input['detail'],
            'is_private' => $input['is_private'],
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

        $realEstate = RealEstate::find($input['id']);
        if ($realEstate) {
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
            $realEstate->position = $input['position'];
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
            $realEstate->approved = $realEstate->draft ? 0 : ( $this->needApprove ? 0 : 1 );
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
        $data->draft = 0;
        $data->approved = $this->needApprove ? 0 : 1;
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
                'name' => $contactPerson,
                'phone' => $phone,
                'address' => $contactAddress
            ]);
            $customer->save();
        }
        return $customer;
    }
}
