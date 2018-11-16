<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\CreateContactRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
    }

    public function getContact()
    {
        return v('contact.contact');
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
