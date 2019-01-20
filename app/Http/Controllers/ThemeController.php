<?php

namespace App\Http\Controllers;

use App\Currency;
use App\ThemeCategory;
use App\Themes;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function getTheme()
    {
        $id = request('theme_category_id');
        if(!empty($id)){
            $data   =   new Themes();
            $data   =   $data->where('theme_category_id', $id);
        }
        else
            $data   =   new Themes();
        $data   =   $data->get();
        $result =   [];
        foreach($data as $item){
            $result[]   =   [
                'id'    =>  $item->id,
                'name'  =>  $item->name,
                'category'  =>  ThemeCategory::find($item->theme_category_id)->name,
                'price'  =>  $item->price,
                'currency'  =>  Currency::where('default',1)->first()->icon,
                'folder'  =>  $item->folder,
            ];
        }
        return response()->json($result);
    }
}
