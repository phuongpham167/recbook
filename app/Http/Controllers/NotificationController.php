<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function read($id)
    {
        $notify =   Notification::find($id);
        if(!empty($notify)){
            $notify->is_read    =   1;
            $notify->save();

            return redirect($notify->url);
        } else {
            return redirect()->back();
        }
    }
}
