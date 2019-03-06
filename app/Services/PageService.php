<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 12/9/2018
 * Time: 11:46 PM
 */

namespace App\Services;


use App\FLDeal;
use App\RealEstate;
use Carbon\Carbon;

class PageService
{
    public function getJoinedFreelance($userId)
    {
        $result = FLDeal::where('user_id', $userId)->whereNotNull('finished_at')->where('is_choosen', 1)->get();
        return $result;
    }
    public function getListBelowDetailPage($type, $excludeIds, $item)
    {
        if ($type == RealEstate::same_search) {
            $sameSearchOption = $this->buildQuery('=', $item);
//            $sameSearchOption->whereNotIn('id', [$item->id]);
            $sameSearchOption->limit(13);
            $result = $sameSearchOption->get();
            return $result;
        }
        if ($type == RealEstate::related_item) {
            $relatedItems = $this->buildQuery('like', $item);

            $relatedItems->limit(50);
            $result = $relatedItems->get();
            return $result;
        }
        return [];
    }

    private function buildQuery($type, $item)
    {
        $query= RealEstate::select('id', 'title', 'short_description', 'slug', 'code',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date', 'detail');
        $query->where('title', 'like', '%' . $item->title . '%');
        if ($item->re_category_id) {
            $query->where('re_category_id', $type , $item->re_category_id);
        }
        if ($item->re_type_id) {
            $query->where('re_type_id', $type, $item->re_type_id);
        }
        if ($item->district_id) {
            $query->where('district_id', $type, $item->district_id);
        }
        if ($item->street_id) {
            $query->where('street_id', $type, $item->street_id);
        }
        if ($item->direction_id) {
            $query->where('direction_id', $type, $item->direction_id);
        }
        if ($item->area_of_premises) {
            $query->where('area_of_premises', $type, $item->area_of_premises);
        }
        $query->orderBy('post_date', 'desc');
        return $query;
    }
}
