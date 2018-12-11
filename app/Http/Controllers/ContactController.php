<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\CreateContactRequest;
use App\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $menuFE;

    public function __construct()
    {
        $web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $web_id)->where('menu_type', $mmfe)->first();
    }

    public function getContact()
    {
        return v('contact.contact', ['menuData' => $this->menuFE]);
    }

    public function postContact(CreateContactRequest $request)
    {
        $data   =   new Contact();
        $data->name   =   $request->name;
        $data->address   =   $request->address;
        $data->mobile   =   $request->mobile;
        $data->note   =   $request->note;
        $data->email   =   $request->email;
        $data->created_at   =   Carbon::now();
        $data->save();
        set_notice(trans('contact.add_success'), 'success');
        return redirect()->back();
    }
}
