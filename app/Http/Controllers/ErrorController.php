<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Services\ProvinceService;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    protected $menuFE, $provinceService;

    public function __construct(
        ProvinceService $provinceService
    )
    {
        $this->provinceService = $provinceService;
        $web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $web_id)->where('menu_type', $mmfe)->first();
    }

    public function notfound()
    {
        return view('errors.404',['menuData' => $this->menuFE]);
    }
    public function fatal()
    {
        return view('errors.500',['menuData' => $this->menuFE]);
    }
}
