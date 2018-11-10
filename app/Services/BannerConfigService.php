<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 10/22/2018
 * Time: 12:11 AM
 */

namespace App\Services;


use App\BannerConfig;

class BannerConfigService
{
    public function store($input)
    {
        $header = [];
        if (isset($input['header'])) {
            $header = $this->prepareData($input['header'], isset($input['header_alt']) ? $input['header_alt'] : []);
        }
        $slide = [];
        if (isset($input['slide'])) {
            $slide = $this->prepareData($input['slide'], $input['slide_alt'] ? $input['slide_alt'] : []);
        }
        $banner_left = [];
        if (isset($input['banner_left'])) {
            $banner_left = $this->prepareData($input['banner_left'], $input['banner_left_alt'] ? $input['banner_left_alt'] : []);
        }
        $banner_right = [];
        if (isset($input['banner_right'])) {
            $banner_right = $this->prepareData($input['banner_right'], $input['banner_right_alt'] ? $input['banner_right_alt'] : []);
        }
        $banner_in_post = [];
        if (isset($input['banner_in_post'])) {
            $banner_in_post = $this->prepareData($input['banner_in_post'], $input['banner_in_post_alt'] ? $input['banner_in_post_alt'] : []);
        }
        $banner_in_body = [];
        if (isset($input['banner_in_body'])) {
            $banner_in_body = $this->prepareData($input['banner_in_body'], $input['banner_in_body_alt'] ? $input['banner_in_body_alt'] : []);
        }

        $bannerConfig = new BannerConfig([
            'header' => json_encode($header),
            'slide' => json_encode($slide),
            'banner_left' => json_encode($banner_left),
            'banner_right' => json_encode($banner_right),
            'banner_in_post' => json_encode($banner_in_post),
            'banner_in_body' => json_encode($banner_in_body)
        ]);

        if($bannerConfig->save()) {
            return $bannerConfig;
        } else {
            return false;
        }
    }

    public function update($input)
    {
        $header = [];
        if (isset($input['header'])) {
            $header = $this->prepareData($input['header'], $input['header_alt']);
        }
        $slide = [];
        if (isset($input['slide'])) {
            $slide = $this->prepareData($input['slide'], $input['slide_alt']);
        }
        $banner_left = [];
        if (isset($input['banner_left'])) {
            $banner_left = $this->prepareData($input['banner_left'], $input['banner_left_alt']);
        }
        $banner_right = [];
        if (isset($input['banner_right'])) {
            $banner_right = $this->prepareData($input['banner_right'], $input['banner_right_alt']);
        }
        $banner_in_post = [];
        if (isset($input['banner_in_post'])) {
            $banner_in_post = $this->prepareData($input['banner_in_post'], $input['banner_in_post_alt']);
        }
        $banner_in_body = [];
        if (isset($input['banner_in_body'])) {
            $banner_in_body = $this->prepareData($input['banner_in_body'], $input['banner_in_body_alt']);
        }

        if ($bannerConfig = BannerConfig::find($input['id'])) {
            $bannerConfig->header = json_encode($header);
            $bannerConfig->slide = json_encode($slide);
            $bannerConfig->banner_left = json_encode($banner_left);
            $bannerConfig->banner_right = json_encode($banner_right);
            $bannerConfig->banner_in_post = json_encode($banner_in_post);
            $bannerConfig->banner_in_body = json_encode($banner_in_body);
            if($bannerConfig->save()) {
                return $bannerConfig;
            } else {
                return false;
            }
        }
        return false;
    }

    private function prepareData($link, $alt)
    {
        $imagesVal = [];
        $images = $link;
        foreach ($images as $key => $image) {
            $imagesVal[] = [
                'link' => $image,
                'alt' => isset($alt[$key]) ? $alt[$key] : ''
            ];
        }
        return $imagesVal;
    }
}