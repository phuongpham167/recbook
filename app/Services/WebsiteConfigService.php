<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 10/13/2018
 * Time: 12:38 AM
 */

namespace App\Services;
use App\WebsiteConfig;

class WebsiteConfigService
{
    public function store($input)
    {
        $websiteConfig = new WebsiteConfig([
           'logo' => $input['logo'],
            'chat_code' => $input['chat_code'],
            'google' => $input['google'],
            'google_app_id' => $input['google_app_id'],
            'facebook' => $input['facebook'],
            'facebook_app_id' => $input['facebook_app_id'],
            'title' => $input['title'],
            'keyword' => $input['keyword'],
            'description' => $input['description']
        ]);

        if($websiteConfig->save()) {
            return $websiteConfig;
        } else {
            return false;
        }
    }

    public function update($input)
    {
        if ($websiteConfig = WebsiteConfig::find($input['id'])) {
            $websiteConfig->logo = $input['logo'];
            $websiteConfig->chat_code = $input['chat_code'];
            $websiteConfig->google = $input['google'];
            $websiteConfig->google_app_id = $input['google_app_id'];
            $websiteConfig->facebook = $input['facebook'];
            $websiteConfig->facebook_app_id = $input['facebook_app_id'];
            $websiteConfig->title = $input['title'];
            $websiteConfig->keyword = $input['keyword'];
            $websiteConfig->description = $input['description'];
            if($websiteConfig->save()) {
                return $websiteConfig;
            } else {
                return false;
            }
        }
        return false;
    }
}