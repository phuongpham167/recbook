<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $menuFE;

    public function __construct()
    {
        $web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $web_id)->where('menu_type', $mmfe)->first();
    }

    public function index()
    {
        $menuData = $this->menuFE;
        return v('pages.home', compact('menuData'));
    }
}
