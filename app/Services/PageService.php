<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 12/9/2018
 * Time: 11:46 PM
 */

namespace App\Services;


use App\RealEstate;
use Carbon\Carbon;

class PageService
{
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
        return RealEstate::select('id', 'title', 'short_description', 'slug', 'code',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('re_category_id', $type , $item->re_category_id)
            ->where('re_type_id', $type, $item->re_type_id)
            ->where('district_id', $type, $item->district_id)
            ->where('street_id', $type, $item->street_id)
            ->where('direction_id', $type, $item->direction_id)
            ->where('area_of_premises', $type, $item->area_of_premises)
            ->where('post_date', '<=', Carbon::now())
            ->orderBy('post_date', 'desc');
    }
}
